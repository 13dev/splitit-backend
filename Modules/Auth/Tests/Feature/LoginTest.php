<?php

namespace Modules\Auth\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Modules\Core\Support\ApiCode;
use Modules\Core\Tests\BaseTest;
use Modules\User\Models\User;

class LoginTest extends BaseTest
{
    use RefreshDatabase;

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
        $this->assertEquals($response->json('code'), ApiCode::CORE_ERROR_VALIDATION);
    }

    public function test_login_with_fake_credentials()
    {
        $response = $this->post('auth/login', [
            'email' => 'fake@fake.com',
            'password' => '12345566789',
        ]);

        $this->assertEquals($response->status(), Response::HTTP_UNAUTHORIZED);
        $this->assertEquals($response->json('code'), ApiCode::AUTH_ERROR_LOGIN);
    }

    public function test_login_with_correct_credentials()
    {
        $user = factory(User::class)->create();

        $response = $this->post('auth/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertEquals($response->status(), Response::HTTP_OK);
        $this->assertEquals($response->json('code'), ApiCode::CORE_SUCCESS_OK);
        $this->assertArrayHasKey('token', $response->json('data'));
    }
}
