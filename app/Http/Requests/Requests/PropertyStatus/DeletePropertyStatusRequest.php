<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\PropertyStatus;


use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\PropertyStatusValidators\DeletePropertyStatusValidator;
use App\Repositories\Repositories\Sql\PropertyStatusRepository;
use App\Transformers\Request\PropertyStatus\DeletePropertyStatusTransformer;

class DeletePropertyStatusRequest extends Request implements RequestInterface{

    public $validator = null;
    private $PropertyStatus = null;
    public function __construct(){
        parent::__construct(new DeletePropertyStatusTransformer($this->getOriginalRequest()));
        $this->validator = new DeletePropertyStatusValidator($this);
        $this->PropertyStatus= new PropertyStatusRepository();
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

    public function getPropertyStatusModel()
    {
        return $this->PropertyStatus->getById($this->get('id'));
    }

} 