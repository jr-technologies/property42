<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:14 AM
 */

namespace App\Repositories\Repositories\Sql;


use App\DB\Providers\SQL\Factories\Factories\Property\PropertyFactory;
use App\DB\Providers\SQL\Factories\Factories\PropertySubType\PropertySubTypeFactory;
use App\DB\Providers\SQL\Models\Property;
use App\DB\Providers\SQL\Models\PropertyType;
use App\Events\Events\Property\PropertyCreated;
use App\Repositories\Interfaces\Repositories\PropertyTypeRepoInterface;
use Illuminate\Support\Facades\Event;


class PropertiesRepository extends SqlRepository implements PropertyTypeRepoInterface
{
    private $factory;
    private $propertySubTypeFactory;
    public function __construct()
    {
        $this->factory = new PropertyFactory();
        $this->propertySubTypeFactory = new PropertySubTypeFactory();
    }

    public function store(Property $property)
    {
        $propertyId = $this->factory->store($property);
        $property->id = $propertyId;
        //Event::fire(new PropertyCreated($property));
        return $propertyId;
    }

    public function getById($id)
    {
        return $this->factory->find($id);
    }

    public function all()
    {
        return $this->factory->all();
    }

    public function propertyCompleteType($propertyId)
    {
        return $this->propertySubTypeFactory->propertyCompleteType($propertyId);
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

    public function getCompleteLocation($id)
    {
        return $this->factory->getCompleteLocation($id);
    }
}