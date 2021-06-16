<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserAuthTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_make_token()
    {
        $data = [
            'username' => 'loveniac',
            'password' => 'password',
            'device_name' => 'mobile'
        ];

        $response = $this->postJson('/api/auth/user', $data);

        $response->assertSuccessful();
        $response->assertHeader('content-type', 'application/json');
    }
}
