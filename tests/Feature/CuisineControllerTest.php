<?php

namespace Tests\Feature;

use App\Models\Cuisine;
use App\Models\SetMenu;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group("cuisine-controller")]
class CuisineControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_cuisines_can_be_returned_without_slug(): void
    {
        $cuisines = Cuisine::factory()->count(3)->create();
        $setMenus = SetMenu::factory()->state(['available' => 1])->count(3)->create();

        $setMenus[0]->cuisines()->attach($cuisines[0]);
        $setMenus[1]->cuisines()->attach($cuisines[1]);
        $setMenus[2]->cuisines()->attach($cuisines[2]);
        $response = $this->get(route("cuisine.index"));
        $response->assertJsonCount(3);
        $response->assertStatus(200);
    }

    public function test_set_menus_count_field_calculated_correctly(): void
    {
        $cuisine = Cuisine::factory()->create();
        $setMenus = SetMenu::factory()->state(['available' => 1])->count(3)->create();

        $setMenus[0]->cuisines()->attach($cuisine);
        $setMenus[1]->cuisines()->attach($cuisine);
        $setMenus[2]->cuisines()->attach($cuisine);
        $response = $this->get(route("cuisine.index"));
        $response->assertJsonCount(1);
        $response->assertJsonFragment(["set_menus_count" => 3]);
        $response->assertStatus(200);
    }

    public function test_set_menus_aggregated_number_of_orders_field_calculated_correctly(): void
    {
        $cuisine = Cuisine::factory()->create();
        $setMenus = SetMenu::factory()->state(['available' => 1])->count(3)->create();

        $setMenus[0]->cuisines()->attach($cuisine);
        $setMenus[1]->cuisines()->attach($cuisine);
        $setMenus[2]->cuisines()->attach($cuisine);
        $response = $this->get(route("cuisine.index"));
        $response->assertJsonCount(1);
        $response->assertJsonFragment(["aggregated_number_of_orders" => SetMenu::all()->sum('number_of_orders')]);
        $response->assertStatus(200);
    }

    public function test_result_ordered_by_aggregate_number_of_orders(): void
    {
        $cuisines = Cuisine::factory()->count(3)->create();
        $setMenus = SetMenu::factory()->state(new Sequence(
            ["number_of_orders" => 3],
            ["number_of_orders" => 20],
            ["number_of_orders" => 13],
        ))->state(['available' => 1])->count(3)->create();

        $setMenus[0]->cuisines()->attach($cuisines[0]);
        $setMenus[1]->cuisines()->attach($cuisines[1]);
        $setMenus[2]->cuisines()->attach($cuisines[2]);
        $response = $this->get(route("cuisine.index"));
        $response
            ->assertJson(fn (AssertableJson $json) => $json
                ->where('0.aggregated_number_of_orders', 20)
                ->where('1.aggregated_number_of_orders', 13)
                ->where('2.aggregated_number_of_orders', 3)
            );
        $response->assertStatus(200);
    }
}
