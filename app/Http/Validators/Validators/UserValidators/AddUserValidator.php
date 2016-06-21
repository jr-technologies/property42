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
            'userRoles.required' => 'User roles is required',
            'termsConditions.required' => $termsConditionsMessage,
            'termsConditions.equals' => $termsConditionsMessage,
            /* Agency messages */
            'agencyName.required' => 'Agency name is required',
            'companyPhone.required' => 'Company phone is required',
            'companyAddress.required' => 'Company address is required',
            'companyEmail.required' => 'Company email is required',
            'companyLogo.max_image_size' => 'Company Logo should be less then or equal to 500 X 500 px'
        ];
    }

    public function userRules()
    {
        return [
            'fName' => 'required',
            'lName' => 'required',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required',
            'passwordAgain' => 'required',
            'phone' => 'required',
            'userRoles' => 'required',
            'termsConditions' => 'required|equals:1'
        ];
    }

    public function agencyRules()
    {
        return [
            'agencyName' => 'required|unique:agencies,agency|max:255',
            'companyPhone' => 'required|max:15',
            'companyAddress' => 'required|max:225',
            'companyEmail' => 'required|email|unique:agencies,email|max:255',
            'agencyDescription'=>'required',
            'companyLogo'=>'mimes:jpeg,bmp,png|image|max_image_size:1000,1000'
        ];
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