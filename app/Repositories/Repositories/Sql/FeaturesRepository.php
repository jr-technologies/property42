<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:14 AM
 */

namespace App\Repositories\Repositories\Sql;


use App\DB\Providers\SQL\Factories\Factories\Feature\FeatureFactory;
use App\DB\Providers\SQL\Models\Features\Feature;
use App\Repositories\Interfaces\Repositories\FeaturesRepoInterface;


class FeaturesRepository extends SqlRepository implements FeaturesRepoInterface
{
    private $factory;
    public function __construct()
    {
         $this->factory = new FeatureFactory();
    }
    public function store(Feature $feature)
    {
        return $this->factory->store($feature);
    }


    public function getById($id)
    {
        return $this->factory->find($id);
    }

    public function getBySubType($subTypeId)
    {
        return $this->factory->getBySubType($subTypeId);
    }

    public function all()
    {
        return $this->factory->all();
    }

    public function update(Feature $feature)
    {
        $this->factory->update($feature);
        return $this->factory->find($feature->id);
    }

    public function delete(Feature $feature)
    {
        return $this->factory->delete($feature);
    }

    public function assignedFeaturesWithValidationRules($subTypeId)
    {
        return $this->factory->assignedFeaturesWithValidationRules($subTypeId);
    }

//    public function getBySociety($id)
//    {
//        return $this->factory->getBySociety($id);
//    }
}