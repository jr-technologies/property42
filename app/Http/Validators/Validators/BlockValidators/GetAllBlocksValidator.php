<?php
/**
 * Created by Waqas Qureshi.
 * User: JR Tech
 * Date: 4/4/2016
 * Time: 4:15 PM
 */

namespace App\Http\Validators\Validators\BlockValidators;


class GetAllBlocksValidator extends BlockValidator implements ValidatorsInterface
{
    public function __construct($request)
    {
        parent::__construct($request);
    }
    public function rules()
    {
        return[];
    }
}

