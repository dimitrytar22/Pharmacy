<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomePageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_main_page_can_be_rendered(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
