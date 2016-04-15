<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\PropertySubType;


use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\PropertySubTypeValidators\DeletePropertySubTypeValidator;
use App\Repositories\Repositories\Sql\PropertySubTypeRepository;
use App\Transformers\Request\PropertySubType\DeletePropertySubTypeTransformer;

class DeletePropertySubTypeRequest extends Request implements RequestInterface{

    public $validator = null;
    private $PropertySubType = null;
    public function __construct(){
        parent::__construct(new DeletePropertySubTypeTransformer($this->getOriginalRequest()));
        $this->validator = new DeletePropertySubTypeValidator($this);
        $this->PropertySubType = new PropertySubTypeRepository();
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

    public function getPropertySubTypeModel()
    {
        return $this->PropertySubType->getById($this->get('id'));
    }

} 