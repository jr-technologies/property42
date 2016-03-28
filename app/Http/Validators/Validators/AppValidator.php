<?php
namespace App\Http\Validators\Validators;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
abstract class AppValidator
{
    public $validationMessages;
    public $authMessages;
    public $request;
    public function __construct($request){
        $this->request = $request;
        $this->__registerCustomRules();
    }

    public function __registerCustomRules(){
        $methods = get_class_methods($this);
        $custom_rules = [];
        foreach($methods as $method){
            if(strpos($method, 'register') === 0 && strpos($method, 'Rule') > 0)
                $custom_rules[] = $method;
        }
        foreach($custom_rules as $rule){
            $this->$rule();
        }
    }

    public function getValidationMessages(){
        return $this->validationMessages;
    }

    public function setValidationMessages($messages){
        $this->validationMessages = $messages;
    }

    public function messages(){
        $messages = [
            //'required' =>'Password field is required',
            'validate_ownership' => 'Ownership Violation! Record is not under this user ownership.',
        ];
        $sub_messages = [];
        if(method_exists($this,'customValidationMessages'))
            $sub_messages = $this->customValidationMessages();
        return array_merge($messages, $sub_messages);
    }

    public function validate(){
        $validator = Validator::make($this->request->all(), $this->rules(), $this->messages());
        if($validator->fails()){
            $this->setValidationMessages($validator->messages()->all());
            return false;
        }
        return true;
    }

    /*
     * defining custom rules for this request
     */
    public function registerNoWhiteSpacesRule(){
        Validator::extend('no_white_spaces',function($attribute, $value, $parameters, $validator){
            if(preg_match('/\s/', $value))
            {
                return false;
            }
            return true;
        });
    }
}