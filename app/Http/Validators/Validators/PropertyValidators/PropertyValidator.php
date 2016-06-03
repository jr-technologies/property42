<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 4:18 PM
 */

namespace App\Http\Validators\Validators\PropertyValidators;

use App\Http\Validators\Validators\AppValidator;
use App\Repositories\Repositories\Sql\FeaturesRepository;

class PropertyValidator extends AppValidator
{
    protected $extraFeatures = null;
    protected $featuresRepository = null;
    public function __construct($request){
        parent::__construct($request);
        $this->featuresRepository = new FeaturesRepository();
        $this->setExtraFeatures();
    }

    protected function setExtraFeatures()
    {
        $this->extraFeatures = $this->featuresRepository->assignedFeaturesWithValidationRules($this->request->get('subTypeId'));
    }

    protected function getExtraFeatures()
    {
        return $this->extraFeatures;
    }

    public function CustomValidationMessages(){
        return [
            //
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

        ];
    }
}