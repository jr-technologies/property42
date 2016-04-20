<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:14 AM
 */

namespace App\Repositories\Repositories\Sql;


use App\DB\Providers\SQL\Factories\Factories\Property\PropertyFactory;
use App\DB\Providers\SQL\Models\Property;
use App\DB\Providers\SQL\Models\PropertyType;
use App\Repositories\Interfaces\Repositories\PropertyTypeRepoInterface;


class PropertiesRepository extends SqlRepository implements PropertyTypeRepoInterface
{
    private $factory;
    public function __construct()
    {
         $this->factory = new PropertyFactory();
    }

    public function store(Property $property)
    {
        return $this->factory->store($property);
    }

    public function getById($id)
    {
        return $this->factory->find($id);
    }

    public function all()
    {
        return $this->factory->all();
    }

    public function update(PropertyType $propertyType)
    {
        $this->factory->update($propertyType);
        return $this->factory->find($propertyType->id);
    }

    public function delete(PropertyType $propertyType)
    {
        return $this->factory->delete($propertyType);
    }
}