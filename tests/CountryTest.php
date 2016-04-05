<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CountryTest extends TestCase
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
    public function testAddCountry()
    {
        $this->json('POST', $this->apiRoute('country'), [
            'country_name' => 'usa',
        ])->seeJson([
            'status' =>1,
        ]);
    }

    /**
     * Checking user inserted in db
     *
     * @return void
     */
    public function testCountryInsertionInDb()
    {
        $this->seeInDatabase('countries', ['country' =>'usa']);
    }

    public function testUpdateCountry()
    {
        $this->json('POST',$this->apiRoute('country/update'),[
            'id' => '1',
            'country_name' => 'usa',
        ])->seeJson([
            'status' => 1
        ]);
    }

    public function testDeleteCountry()
    {
        $this->json('POST',$this->apiRoute('countries'),['id'=>3])->seeJson(['status'=> 1]);
    }

}