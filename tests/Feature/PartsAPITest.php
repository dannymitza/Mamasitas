<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PartsAPITest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        echo 'http://api.localhost/parts';
        $response = $this->json('GET', 'http://api.localhost/parts');
        $response->assertStatus(200);
    }
}
