<?php
/**
 * Created by Noman Tufail.
 * User: waqas
 * Date: 3/21/2016
 * Time: 9:22 AM
 */

namespace App\Http\Validators\Validators\UserValidators;

use App\Http\Validators\Interfaces\ValidatorsInterface;
use App\Repositories\Providers\Providers\UsersJsonRepoProvider;
use Illuminate\Support\Facades\Validator;

class ApproveAgentValidator extends UserValidator implements ValidatorsInterface
{
    public function __construct($request)
    {
        parent::__construct($request);
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'userId'=>'required',
        ];
    }

}