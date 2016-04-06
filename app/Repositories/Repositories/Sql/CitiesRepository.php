<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 3/16/2016
 * Time: 9:57 AM
 */

namespace App\Repositories\Repositories\Sql;

use App\DB\Providers\SQL\Factories\Factories\City\CityFactory;
use App\DB\Providers\SQL\Models\City;
use App\DB\Providers\SQL\Models\Country;
use App\Repositories\Interfaces\Repositories\UsersRepoInterface;

class CitiesRepository extends SqlRepository implements UsersRepoInterface
{
    private $cityTransformer;
    private $factory = null;
    public function __construct(){
        $this->cityTransformer = null;
        $this->factory = new CityFactory();
    }

    public function getById($id)
    {
        return $this->factory->find($id);
    }

    public function all()
    {
        return $this->factory->all();
    }

    public function update(City $city)
    {
        $this->factory->update($city);
        return $this->factory->find($city->id);
    }

    public function store(City $city)
    {
        $city->id = $this->factory->store($city);
        return $city;
    }

    public function delete(City $city)
    {
        return $this->factory->delete($city);
    }

    public function getByCountry($countryId)
    {
        return $this->factory->getByCountry($countryId);
    }

    public function getBySociety($societyId)
    {
        return $this->factory->getBySociety($societyId);
    }
}
