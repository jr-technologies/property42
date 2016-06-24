<?php
/**
 * Created by Noman Tufail.
 * User: waqas
 * Date: 3/21/2016
 * Time: 9:22 AM
 */

namespace App\Http\Validators\Validators\UserValidators;

use App\Http\Requests\Requests\Auth\RegistrationRequest;
use App\Http\Validators\Interfaces\ValidatorsInterface;
use App\Repositories\Providers\Providers\SocietiesRepoProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AddUserValidator extends UserValidator implements ValidatorsInterface
{

    /**
     * @param RegistrationRequest $request
     */
    public function __construct(RegistrationRequest $request){
        parent::__construct($request);
        $this->request = $request;
    }
    public function CustomValidationMessages(){
        $termsConditionsMessage ='Dear user you must agree our terms and conditions';
        return [
            'required.required' => ':attribute is required',
            'fName.required' => 'First name is required',
            'lName.required' => 'Last name is required',
            'passwordAgain.required' => 'Password Again is required',
            'phone.required' => 'Phone is required',
            'userRoles.required' => 'please select atleast one role',
            'termsConditions.required' => $termsConditionsMessage,
            'termsConditions.equals' => $termsConditionsMessage,
            /* Agency messages */
            'agencyName.required' => 'Agency name is required',
            'agencyName.unique_agent_in_societies' => ':conflictedSocieties',
            'companyPhone.required' => 'Company phone is required',
            'companyAddress.required' => 'Company address is required',
            'societies.required' => 'please select atleast one society',
            'companyEmail.required' => 'Company email is required',
            'companyLogo.max_image_size' => 'Company Logo should be less then or equal to 1000 X 1000 px'
        ];
    }

    public function userRules()
    {
        return [
            'fName' => 'required|min:3|max:55',
            'lName' => 'required|min:3|max:55',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|min:5|max:15',
            'passwordAgain' => 'required|min:5|max:15',
            'phone' => 'required|min:5|max:15',
            'userRoles' => 'required',
            'termsConditions' => 'required|equals:1'
        ];
    }

    public function agencyRules()
    {
        return [
            'agencyName' => 'required|max:255|unique_agent_in_societies',
            'companyPhone' => 'required|max:15',
            'companyAddress' => 'required|max:225',
            'societies' => 'required',
            'companyEmail' => 'required|email|unique:agencies,email|max:255',
            'agencyDescription'=>'max:600',
            'companyLogo'=>'mimes:jpeg,bmp,png|image|max_image_size:1000,1000'
        ];
    }
    public function registerSocietiesInDealRule()
    {
        Validator::extend('unique_agent_in_societies', function($attribute, $value, $parameters)
        {
            $societies = $this->request->get('societies');
            $societies = ($societies == null)?[]: $societies;
            $finalRecord = [];
            $existingSocieties = (new SocietiesRepoProvider())->repo()->getSocietiesYouDealIn($this->request->get('agencyName'));
            foreach ($societies as $key => $val) {
                foreach ($existingSocieties as $society) {
                    if ($val == $society->id) {
                        $finalRecord[] = $society;
                    }
                }
            }
            dd('working here...');
        });
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return ($this->request->userIsAgent())?array_merge($this->userRules(),$this->agencyRules()):$this->userRules();
    }
}