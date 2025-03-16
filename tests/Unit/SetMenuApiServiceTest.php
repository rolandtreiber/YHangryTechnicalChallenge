<?php

namespace Tests\Unit;

use App\Exceptions\CuisineCannotBeParsedException;
use App\Exceptions\SetMenuCannotBeParsedException;
use App\Http\Service\ApiDataHandlerService;
use App\Http\Service\ApiDataHandlerServiceImpl;
use App\Models\SetMenu;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Group;
use Tests\Mock\Service\InvalidDataMockSetMenuApiServiceMissingCuisineName;
use Tests\Mock\Service\InvalidDataMockSetMenuApiServiceMissingSetMenuValues;
use Tests\Mock\Service\ValidDataMockSetMenuApiService;
use Tests\TestCase;

#[Group("set-menu-api-service")]
class SetMenuApiServiceTest extends TestCase
{
    use RefreshDatabase;

    private ApiDataHandlerService $apiDataHandler;

    /**
     * @throws BindingResolutionException
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->apiDataHandler = new ApiDataHandlerServiceImpl(app()->make(ValidDataMockSetMenuApiService::class));
    }

    public function test_retrieves_all_data(): void
    {
        $data = $this->apiDataHandler->retrieveData(1)['data'];
        do {
            $nextPage = $this->apiDataHandler->retrieveNextPage();
            $data = array_merge($data, $nextPage['data']);
        } while ($nextPage['links']['next']);

        $this->assertCount(80, $data);
    }

    public function test_extracts_single_page_data(): void
    {
        $data = $this->apiDataHandler->extractData($this->apiDataHandler->retrieveData(1)['data']);
        $this->assertCount(10, $data);
        $this->assertEquals("Italiano Delight", $data[0]->get()['name']);
        $this->assertEquals("Italian", $data[0]->getCuisines()->first()->get()['name']);
        $this->assertEquals("italian", $data[0]->getCuisines()->first()->get()['slug']);
    }

    public function test_missing_cuisine_name_throws_exception(): void
    {
        $this->expectException(CuisineCannotBeParsedException::class);
        $this->apiDataHandler = new ApiDataHandlerServiceImpl(app()->make(InvalidDataMockSetMenuApiServiceMissingCuisineName::class));
        $this->apiDataHandler->extractData($this->apiDataHandler->retrieveData(1)['data']);
    }

    public function test_missing_menu_values_throws_exception(): void
    {
        $this->expectException(SetMenuCannotBeParsedException::class);
        $this->apiDataHandler = new ApiDataHandlerServiceImpl(app()->make(InvalidDataMockSetMenuApiServiceMissingSetMenuValues::class));
        $this->apiDataHandler->extractData($this->apiDataHandler->retrieveData(1)['data']);
    }

    /**
     * @throws SetMenuCannotBeParsedException
     * @throws CuisineCannotBeParsedException
     */
    public function test_one_page_of_data_is_persisted(): void
    {
        $data = $this->apiDataHandler->extractData($this->apiDataHandler->retrieveData(1)['data']);
        $this->apiDataHandler->persistData($data);

        $this->assertDatabaseCount('cuisines', 6);
        $this->assertDatabaseCount('set_menus', 10);
    }

    /**
     * @throws SetMenuCannotBeParsedException
     * @throws CuisineCannotBeParsedException|BindingResolutionException
     */
    public function test_entire_dataset_is_persisted(): void
    {
        $data = $this->apiDataHandler->retrieveData(1)['data'];
        $this->apiDataHandler->setActivePage(1);
        do {
            $nextPage = $this->apiDataHandler->retrieveNextPage();
            $data = array_merge($data, $nextPage['data']);
        } while ($nextPage['links']['next']);
        $data = $this->apiDataHandler->extractData($data);
        $this->apiDataHandler->persistData($data);

        $this->assertDatabaseCount('cuisines', 15);
        $this->assertDatabaseCount('set_menus', 80);
    }

    public function test_relationships_were_persisted(): void
    {
        $data = $this->apiDataHandler->extractData($this->apiDataHandler->retrieveData(1)['data']);
        $this->apiDataHandler->persistData($data);

        $menu = SetMenu::first();
        $this->assertCount(1, $menu->cuisines);
        $this->assertDatabaseCount('cuisine_set_menu', 10);
    }

}
