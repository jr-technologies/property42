<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:14 AM
 */

namespace App\Repositories\Repositories\Sql;


use App\DB\Providers\SQL\Factories\Factories\FavouriteProperty\FavouritePropertyFactory;
use App\DB\Providers\SQL\Factories\Factories\Property\PropertyFactory;
use App\DB\Providers\SQL\Factories\Factories\PropertySubType\PropertySubTypeFactory;
use App\DB\Providers\SQL\Models\FavouriteProperty;
use App\DB\Providers\SQL\Models\Property;
use App\DB\Providers\SQL\Models\PropertyType;
use App\Events\Events\Property\PropertiesStatusChanged;
use App\Events\Events\Property\PropertyCreated;

use App\Repositories\Interfaces\Repositories\PropertyTypeRepoInterface;
use Illuminate\Support\Facades\Event;


class PropertiesRepository extends SqlRepository implements PropertyTypeRepoInterface
{
    private $factory;
    private $propertySubTypeFactory;
    private $favouriteFactory;
    public function __construct()
    {
        $this->factory = new PropertyFactory();
        $this->favouriteFactory = new FavouritePropertyFactory();
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
    public function update(Property $property)
    {
      return $this->factory->update($property);
    }

    public function delete(Property $property)
    {
        return  $this->factory->delete($property);
    }

    public function deleteByIds(array $propertyIds)
    {
        $result = $this->factory->deleteByIds($propertyIds);
        Event::fire(new PropertiesStatusChanged($propertyIds, (new \PropertyStatusTableSeeder())->getDeletedStatusId()));
    }

    public function forceDelete(Property $property)
    {
        return  $this->factory->forceDelete($property);
    }
    public function getCompleteLocation($id)
    {
        return $this->factory->getCompleteLocation($id);
    }
    public function countProperties($userId)
    {
        return $this->factory->countProperties($userId);
    }
    public function favouriteProperty(FavouriteProperty $addToFavourite)
    {
        return $this->favouriteFactory->store($addToFavourite);
    }
}