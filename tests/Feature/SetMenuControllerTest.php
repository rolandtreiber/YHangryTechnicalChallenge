<?php

namespace Tests\Feature;

use App\Models\Cuisine;
use App\Models\SetMenu;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group("set-menu-controller")]
class SetMenuControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_set_menus_can_be_returned(): void
    {
        $response = $this->get(route("set-menu.index", [
            "page" => 1,
        ]));

        $response->assertStatus(200);
    }

    public function test_all_cuisines_are_returned_if_no_slug_is_specified(): void
    {
        $cuisine = Cuisine::factory()->create();
        $setMenus = SetMenu::factory()->state([
            "available" => 1
        ])->count(3)->create();
        foreach ($setMenus as $setMenu) {
            $setMenu->cuisines()->attach($cuisine);
        }

        $response = $this->get(route("set-menu.index", [
            "page" => 1,
        ]));

        $this->assertCount(3, $response->json('data'));
    }

    public function test_cuisines_are_returned_by_slug(): void
    {
        $cuisines = Cuisine::factory()->count(2)->create();
        $setMenus = SetMenu::factory()->state([
            "available" => 1
        ])->count(3)->create();
        $setMenus[0]->cuisines()->attach($cuisines[0]);
        $setMenus[1]->cuisines()->attach($cuisines[1]);
        $setMenus[2]->cuisines()->attach($cuisines[1]);

        $response = $this->get(route("set-menu.index", [
            "page" => 1,
            "cuisineSlug" => $cuisines[1]->slug
        ]));

        $this->assertCount(2, $response->json('data'));
        $this->assertEquals($response->json('data.0.cuisines.0.name'), $cuisines[1]->name);
        $this->assertEquals($response->json('data.1.cuisines.0.name'), $cuisines[1]->name);
    }

    public function test_prices_are_calculated_correctly(): void
    {
        $setMenu = SetMenu::factory()->state([
            "available" => 1
        ])->create();

        $response = $this->get(route("set-menu.index", [
            "page" => 1,
            "number_of_guests" => 12
        ]));

        $this->assertEquals($response->json('data.0.price'), $setMenu->price * 12);
    }

}
