<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\AuthService;

class AuthServiceTest extends TestCase
{
    public function testRegisterUser()
    {
        $authService = new AuthService();

        $user = $authService->register([
            'name' => 'smiya lkniya',
            'email' => 'wahdlemail.com',
            'password' => 'lkod dyalk',
        ]);

        $this->assertNotNull($user);
    }
}
