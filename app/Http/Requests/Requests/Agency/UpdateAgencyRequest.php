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
use App\Http\Validators\Validators\AgencyValidators\UpdateAgencyValidator;
use App\Transformers\Request\Agency\UpdateAgencyTransformer;

class UpdateAgencyRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct()
    {
        parent::__construct(new UpdateAgencyTransformer($this->getOriginalRequest()));
        $this->validator = new UpdateAgencyValidator($this);
    }

    public function authorize()
    {
        return true;
    }

    public function validate()
    {
        return $this->validator->validate();
    }

    /**
     * @return Agency::class
     * */
    public function getAgencyModel()
    {
        $agency= new Agency();
        $agency->id= $this->get('agency_id');
        $agency->userId= $this->get('user_id');
        $agency->name= $this->get('agency_name');
        $agency->description= $this->get('description');
        $agency->mobile= $this->get('mobile');
        $agency->phone= $this->get('phone');
        $agency->address= $this->get('address');
        $agency->email= $this->get('email');
        $agency->logo= $this->get('logo');
        return $agency;

    }

} 