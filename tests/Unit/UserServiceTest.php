<?php

namespace Tests\Feature;

use Tests\TestCase;

class UserServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @test
     */
    public function basicRequest()
    {

        $response = $this->get('api/test');
        $response->assertSuccessful(200);
        $this->assertEquals('coucou', $response->getContent());
    }

    /**
     * @test
     */
    public function basicCalcul()
    {
        $data = [10, 20, 30];
        $result = array_sum($data);
        $this->assertEquals(60, $result);
    }

    /**
     * @test
     */
    public function basicMessage()
    {
        $response = $this->get('/api/test/message');
        $response->assertViewHas('message', 'Vous y êtes !');
    }
}
