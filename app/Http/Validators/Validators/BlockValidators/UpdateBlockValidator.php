<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 4/4/2016
 * Time: 4:15 PM
 */

namespace App\Http\Validators\Validators\BlockValidators;


use App\Http\Validators\Interfaces\ValidatorsInterface;

class UpdateBlockValidator extends BlockValidator implements ValidatorsInterface
{
    public function __construct($request)
    {
        parent::__construct($request);
    }
    public function rules()
    {
        return[
            'id' => 'required',
            'block'=>'required',
            'societyId' => 'required'
        ];
    }
}

