<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\Agency;


use App\DB\Providers\SQL\Models\Agency;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\AgencyValidators\AddAgencyValidator;
use App\Transformers\Request\Agency\AddAgencyTransformer;

class AddAgencyRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new AddAgencyTransformer($this->getOriginalRequest()));
        $this->validator = new AddAgencyValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

    /**
     * @return Agency::class
     * */
    public function getAgencyModel()
    {
        $Agency= new Agency();
        $Agency->userId= $this->get('user_id');
        $Agency->name= $this->get('agency_name');
        $Agency->description= $this->get('description');
        $Agency->mobile= $this->get('mobile');
        $Agency->phone= $this->get('phone');
        $Agency->address= $this->get('address');
        $Agency->email= $this->get('email');
        $Agency->logo= $this->get('logo');
        return $Agency;
    }

} 