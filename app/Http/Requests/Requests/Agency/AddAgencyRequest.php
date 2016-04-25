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
        $Agency->userId= $this->get('userId');
        $Agency->name= $this->get('agencyName');
        $Agency->description= $this->get('description');
        $Agency->mobile= $this->get('companyMobile');
        $Agency->phone= $this->get('companyPhone');
        $Agency->address= $this->get('companyAddress');
        $Agency->email= $this->get('companyEmail');
        $Agency->logo= $this->get('companyLogo');
        return $Agency;
    }

} 