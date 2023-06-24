<?php

namespace Tests\Feature;

use Classie\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use DatabaseTransactions;

    public function testUserCanLogIn()
    {
//        $user = User::factory()->create();
//
//        $this->get('login')
//            ->submitForm('Login', [
//                'email' => $user->email,
//                'password' => 'secret'])
//            ->seePageIs('/home');
    }
}
