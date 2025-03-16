<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group("cuisine-controller")]
class CuisineControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_cuisines_can_be_returned_without_slug(): void
    {
        $response = $this->get(route("cuisine.index", [
            "page" => 1,
        ]));

        $response->assertStatus(200);
    }
}
