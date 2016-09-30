<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Classie\User;

class AuthTest extends TestCase
{
    use DatabaseTransactions;

    public function testUserCanLogIn()
    {
        $user = factory(User::class)->create();

        $this->visit('login')
             ->submitForm('Login', [
                'email' => $user->email,
                'password' => 'secret'])
             ->seePageIs('/home');
    }
}
