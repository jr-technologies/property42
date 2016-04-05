<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 3/16/2016
 * Time: 9:57 AM
 */

namespace App\Repositories\Repositories\Sql;

use App\DB\Providers\SQL\Factories\Factories\Country\CountryFactory;
use App\DB\Providers\SQL\Models\Country;
use App\Repositories\Interfaces\Repositories\UsersRepoInterface;

class CountriesRepository extends SqlRepository implements UsersRepoInterface
{
    private $countryTransformer;
    private $factory = null;
    public function __construct(){
        $this->userTransformer = null;
        $this->factory = new CountryFactory();
    }

    public function getById($id)
    {
        return $this->factory->find($id);
    }

    public function all()
    {
        return $this->factory->all();
    }

    public function update(Country $country)
    {
        // update karwana hai abi...

        return $this->getById($country->id);
    }

    public function store(Country $country)
    {
        $country->id = $this->factory->store($country);
        return $country;
    }

    public function delete(Country $country)
    {
        echo('Delete functionality is not implemented');
        //$this->factory->delete($country);
        return true;
    }
}
