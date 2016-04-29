<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\LandUnit;


use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\LandUnitValidators\DeleteLandUnitValidator;
use App\Repositories\Repositories\Sql\LandUnitsRepository;
use App\Transformers\Request\LandUnit\DeleteLandUnitTransformer;

class DeleteLandUnitRequest extends Request implements RequestInterface{

    public $validator = null;
    private $landUnit = null;
    public function __construct(){
        parent::__construct(new DeleteLandUnitTransformer($this->getOriginalRequest()));
        $this->validator = new DeleteLandUnitValidator($this);
        $this->landUnit = new LandUnitsRepository();
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

    public function getLandUnitModel()
    {
        return $this->landUnit->getById($this->get('id'));
    }

} 