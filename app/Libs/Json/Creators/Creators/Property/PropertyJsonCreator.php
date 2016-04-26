<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/25/2016
 * Time: 11:39 AM
 */

namespace App\Libs\Json\Creators\Creators\Property;

use App\DB\Providers\SQL\Models\Property;
use App\DB\Providers\SQL\Models\PropertyPurpose;
use App\Libs\Json\Creators\Creators\JsonCreator;
use App\Libs\Json\Creators\Creators\Property\Owner\PropertyOwnerJsonCreator;
use App\Libs\Json\Creators\Interfaces\JsonCreatorInterface;
use App\Libs\Json\Prototypes\Prototypes\Property\PropertyJsonPrototype;
use App\Repositories\Repositories\Sql\FeaturesRepository;
use App\Repositories\Repositories\Sql\UsersRepository;

class PropertyJsonCreator extends JsonCreator implements JsonCreatorInterface
{
    private $featuresRepository = null;
    private $usersRepository = null;
    public function __construct(Property $property = null)
    {
        $this->model = $property;
        $this->prototype = new PropertyJsonPrototype();
        $this->featuresRepository = new FeaturesRepository();
        $this->usersRepository = new UsersRepository();
    }

    public function create()
    {
        $this->prototype->id = $this->model->id;

        $this->prototype->owner = $this->getOwnerJson();
        $this->prototype->purpose = $this->getPurpose()->name;
        $this->prototype->type = $this->getPropertyType();
        $this->prototype->location = $this->getPropertyLocation();

        $this->prototype->title = $this->model->title;
        $this->prototype->description = $this->model->description;
        $this->prototype->price = $this->model->price;
        $this->prototype->land = $this->getLand();
        $this->prototype->propertyStatus = $this->getPropertyStatus();
        $this->prototype->isFeatured = $this->model->isFeatured;
        $this->prototype->isHot = $this->model->isHot;
        $this->prototype->isDeleted = $this->isDeleted();
        $this->prototype->createdBy = $this->model->createdBy;
        $this->prototype->totalViews = $this->model->totalViews;
        $this->prototype->rating = $this->model->ratings;
        $this->prototype->totalLikes = $this->model->totalLikes;
        $this->prototype->documents = $this->getDocuments();
        $this->prototype->features = $this->getFeatures();

        return $this->prototype;
    }

    private function getFeatures()
    {
        $featuresJsonCreator = new PropertyFeaturesJsonCreator($this->featuresRepository->getAPropertyFeaturesWithValues($this->model->id));
        return $featuresJsonCreator->create();
    }

    private function getDocuments()
    {
        return 'property documents object aye ga';
    }

    private function isDeleted()
    {
        return false;
    }

    private function getPropertyStatus()
    {
        return 'yahan property status ka object aye ga.';
    }

    private function getLand()
    {
        return 'yahan property land ka object aye ga';
    }

    private function getOwnerJson()
    {
        return (new PropertyOwnerJsonCreator($this->usersRepository->getById($this->model->ownerId)))->create();
    }

    private function getPropertyType()
    {
        return 'property type ka object aye ga';
    }

    private function getPropertyLocation()
    {
        return 'property location ka object aye ga';
    }

    /**
     * @return PropertyPurpose
     */
    private function getPurpose()
    {
        $thisPropertyPurpose = config('constants.PROPERTY_PURPOSES')[$this->model->purposeId];
        $purpose = new PropertyPurpose();
        $purpose->id = $this->model->purposeId;
        $purpose->name = $thisPropertyPurpose;

        return $purpose;
    }
}