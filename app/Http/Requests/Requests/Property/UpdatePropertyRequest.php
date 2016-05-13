<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\Property;


use App\DB\Providers\SQL\Models\City;
use App\DB\Providers\SQL\Models\Features\Feature;
use App\DB\Providers\SQL\Models\Features\PropertyFeatureValue;
use App\DB\Providers\SQL\Models\Property;
use App\DB\Providers\SQL\Models\PropertyDocument;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\PropertyValidators\UpdatePropertyValidator;
use App\Repositories\Providers\Providers\FeaturesRepoProvider;
use App\Transformers\Request\Property\UpdatePropertyTransformer;

class UpdatePropertyRequest extends Request implements RequestInterface{

    public $validator = null;
    private $features = null;
    public function __construct()
    {
        parent::__construct(new UpdatePropertyTransformer($this->getOriginalRequest()));
        $this->validator = new UpdatePropertyValidator($this);
        $this->features = (new FeaturesRepoProvider())->repo();
    }

    public function getPropertyModel()
    {
        $property = new Property();

        $property->id = $this->get('propertyId');
        $property->purposeId = $this->get('purposeId');
        $property->subTypeId =  $this->get('subTypeId');
        $property->blockId =  $this->get('blockId');
        $property->title =  $this->get('title');
        $property->description =  $this->get('description');
        $property->price =  $this->get('price');
        $property->landArea =  $this->get('landArea');
        $property->landUnitId =  $this->get('landUnitId');

        $property->statusId = 1;

        $property->contactPerson =  $this->get('contactPerson');
        $property->phone =  $this->get('phone');
        $property->mobile =  $this->get('mobile');
        $property->email =  $this->get('email');
        $property->ownerId = $this->get('ownerId');
        $property->createdBy = 1;

        return $property;
    }

    public function getFeaturesValues($propertyId)
    {
        $submittedFeatures = $this->getSubmittedPropertyFeatures();
        $featureValues = [];
        foreach($submittedFeatures as $feature /* @var $feature Feature */)
        {
            $featureValue = new PropertyFeatureValue();
            $featureValue->propertyId = $propertyId;
            $featureValue->propertyFeatureId = $feature->id;
            $featureValue->value = $this->getFeature($feature->inputName);
            $featureValue->updatedAt = date('Y-m-d h:i:s');
            $featureValues[] = $featureValue;
        }
        return $featureValues;
    }

    public function getSubmittedPropertyFeatures()
    {
        $features = $this->features->getBySubType($this->get('subTypeId'));
        $finalFeatures = [];
        foreach($features as $feature /* @var $feature Feature */)
        {
            if($this->getFeature($feature->inputName) != null)
                $finalFeatures[] = $feature;
        }
        return $finalFeatures;
    }

    public function getPropertyDocuments($propertyId = null)
    {
        $documents = [];

        $document = new PropertyDocument();
        $document->propertyId = $propertyId;
        $document->path = 'its a path';
        $document->title = 'bedrooms';

        $documents[] = $document;

        return $documents;
    }

    public function getFeature($featureName)
    {
        return $this->getOriginal($featureName);
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

    /**
     * @return City::class
     * */
} 