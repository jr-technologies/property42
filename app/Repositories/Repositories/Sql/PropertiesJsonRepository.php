<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/16/2016
 * Time: 9:57 AM
 */

namespace App\Repositories\Repositories\Sql;


use App\DB\Providers\SQL\Factories\Factories\PropertyJson\PropertyJsonFactory;
use App\Libs\Json\Prototypes\Prototypes\Property\PropertyJsonPrototype;
use App\Repositories\Interfaces\Repositories\PropertiesJsonRepoInterface;

class PropertiesJsonRepository extends SqlRepository implements PropertiesJsonRepoInterface
{
    private $userJsonTransformer;
    private $factory = null;
    public function __construct(){
        $this->userJsonTransformer = null;
        $this->factory = new PropertyJsonFactory();
    }

    public function all()
    {
        return $this->factory->all();
    }

    public function search()
    {

    }

    public function find($id)
    {
        return $this->factory->find($id);
    }

    public function store(PropertyJsonPrototype $property)
    {
        return $this->factory->store($property);
    }

    public function update($property)
    {
        return $this->factory->update($property);
    }

    public function delete($id)
    {
        return $this->factory->delete($id);
    }
    public function getUserProperties($params)
    {
        return $this->factory->getUserProperties($params);
    }
    public function countSearchedUserProperties($params)
    {
        return $this->factory->countSearchedUserProperties($params);
    }
    public function getById($propertyId)
    {
        return $this->factory->getById($propertyId);
    }
}
