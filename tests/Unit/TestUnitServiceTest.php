<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TestUnitServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_json()
    {
        $response = $this->get('api/json-test');

        $response->assertStatus(200);
        $response->assertJson([

            'updated' => true,

        ]);

    }

    public function test_json_name()
    {
        $response = $this->get('api/json-test');

        $response->assertStatus(200);
        $response->assertJson([

            'name' => 'Jone',

        ]);

    }
}
