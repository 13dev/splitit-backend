<?php

namespace Modules\Auth\Tests\Feature;

use Illuminate\Http\Response;
use Modules\Core\Tests\BaseTest;

class LoginTest extends BaseTest
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_login_empty_credentials()
    {
        $response = $this->post('auth/login', [
            'email' => '',
            'password' => '',
        ]);

        $this->assertEquals($response->status(), Response::HTTP_BAD_REQUEST);

        $response = $this->post('auth/login', [
            'email' => 'Eemail',
            'password' => '',
        ]);

        $this->assertEquals($response->status(), Response::HTTP_BAD_REQUEST);
    }

    public function test_login_with_fake_credentials()
    {
        $response = $this->post('auth/login', [
            'email' => 'fake@fake.com',
            'password' => '12345566789',
        ]);

        $this->assertEquals($response->status(), Response::HTTP_UNAUTHORIZED);
    }
}
