<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\UserRole;


use App\Transformers\Request\RequestTransformer;


class AddUserRoleTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'userRole'=>$this->request->input('user_role'),

        ];
    }
}