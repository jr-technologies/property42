<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\Agency;


use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\AgencyValidators\GetAgencyStaffValidator;
use App\Transformers\Request\Agency\GetAgencyStaffTransformer;

class GetAgencyStaffRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new GetAgencyStaffTransformer($this->getOriginalRequest()));
        $this->validator = new GetAgencyStaffValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

} 