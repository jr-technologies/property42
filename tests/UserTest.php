<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    private $userEmail = 'jrteam@gmail.com';
    private $userPassword = '123';

    public function generateUniqueEmail()
    {
        $email = date('Y-m-d-h-i-s')."@gmail.com";
        $this->userEmail = $email;
        return $email;
    }

    /**
     * Testing user Registration
     *
     * @return void
     */
    public function testUserRegistration()
    {
        $this->json('POST', $this->apiRoute('register'), [
            'f_name' => 'unit',
            'l_name'=>'test',
            'email'=>$this->generateUniqueEmail(),
            'password'=>$this->userPassword
        ])->seeJson([
            'status' =>1,
        ]);
    }

    /**
     * Checking user inserted in db
     *
     * @return void
     */
    public function testUserInsertionInDb()
    {
        $this->seeInDatabase('users', ['email' => $this->userEmail]);
    }

    /**
     * Testing user login
     *
     * @return void
     */
    public function testUserLogin()
    {
        $this->json('POST', $this->apiRoute('login'), [
            'email' => $this->userEmail,
            'password'=>$this->userPassword
        ])->seeJson([
            'status' => 1,
        ]);
    }
}
