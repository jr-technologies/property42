<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/1/2016
 * Time: 9:34 PM
 */

namespace App\DB\SQL\Factories\User;

use App\DB\SQL\Factories\Eloquent;
use App\DB\SQL\Factories\QueryBuilder;
use App\DB\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\SQL\Models\User as UserModel;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class User extends QueryBuilder implements SQLFactoriesInterface{
    public function __construct()
    {
        $this->table = "users";
        $this->model = new UserModel();
    }

    /**
     * @return UserModel::class
     **/
    public function find($id)
    {
        return parent::find($id);
    }

    /**
     * @param $result
     * @return UserModel::class
     **/
    public function map($result)
    {
        $user = $this->model;
        $user->id = $result->id;
        $user->fName = $result->f_name;
        return $user;
    }
}
