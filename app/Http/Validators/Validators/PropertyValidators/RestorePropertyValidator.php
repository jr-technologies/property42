<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 4:15 PM
 */

namespace App\Http\Validators\Validators\PropertyValidators;

use App\Http\Validators\Interfaces\ValidatorsInterface;
use App\Repositories\Providers\Providers\PropertiesJsonRepoProvider;
use Illuminate\Support\Facades\Validator;
class RestorePropertyValidator extends PropertyValidator implements ValidatorsInterface
{
    private $propertyJsonRepo = "";
    public function __construct($request)
    {
        parent::__construct($request);
        $this->propertyJsonRepo = (new PropertiesJsonRepoProvider())->repo();
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'propertyId'=>'required|exists:properties,id|property_exists_in_deleted_section',
        ];
    }
    public function registerPropertyIsDeletedRule()
    {
        Validator::extend('property_exists_in_deleted_section', function($attribute, $value, $parameters)
        {
            $this->propertyJsonRepo = (new PropertiesJsonRepoProvider())->repo();
            try {
                $property = $this->propertyJsonRepo->getById(13);
                $isInDeletedSection = false;

                if ($property->propertyStatus->id == 25 )
                {
                    $isInDeletedSection = true;
                }

                if (!$isInDeletedSection)
                    return false;

            } catch (\Exception $e)
            {
                return false;
            }
            return true;
        });
    }
}

