<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CityTest extends TestCase
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
    public function testAddCity()
    {
        $this->json('POST', $this->apiRoute('city'), [
            'city_name' => 'karachi',
            'country_id' => 1
        ])->seeJson([
            'status' =>1,
        ]);
    }

    /**
     * Checking user inserted in db
     *
     * @return void
     */
    public function testCityInsertionInDb()
    {
        $this->seeInDatabase('cities', ['city' =>'karachi']);
    }

    public function testUpdateCity()
    {
        $this->json('POST',$this->apiRoute('city/update'),[
            'city_id' => 1,
            'country_id' => 1,
            'city_name' => 'usa',
        ])->seeJson([
            'status' => 1
        ]);
    }

    public function testAllCities()
    {
        $this->json('GET',$this->apiRoute('cities'),[])->seeJson([
            'status' => 1
        ]);
    }

    public function testDeleteCity()
    {
        $this->json('POST',$this->apiRoute('city/delete'),['city_id'=>2])->seeJson(['status'=> 1]);
    }

}
