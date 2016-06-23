<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 4:15 PM
 */

namespace App\Http\Validators\Validators\MailValidators;


use App\Http\Validators\Interfaces\ValidatorsInterface;

class AgentMailValidator extends MailValidator implements ValidatorsInterface
{
    public function __construct($request)
    {
        parent::__construct($request);
    }
    public function rules()
    {
        return[
            'subject' => 'required|min:5|max:15',
            'name'=>'required|min:5|max:15',
            'email' => 'required|email|min:5|max:255',
            'phone'=>'required|min:5|max:15',
            'cell' => 'required|numeric',
            'message'=>'required|min:5|max:300'
        ];
    }
}

