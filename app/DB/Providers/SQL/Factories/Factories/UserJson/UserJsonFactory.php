<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/1/2016
 * Time: 9:34 PM
 */

namespace App\DB\Providers\SQL\Factories\Factories\User;

use App\DB\Providers\SQL\Factories\Factories\UserJson\Gateways\UserJsonQueryBuilder;
use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Factories\Factories\User\Gateways\UserQueryBuilder;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\Objects\User as UserModel;

class UserJsonFactory extends SQLFactory implements SQLFactoriesInterface{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new UserModel();
        $this->tableGateway = new UserJsonQueryBuilder();
    }

    /**
     * @return array UserModel::class
     **/
    public function all()
    {
        return $this->mapCollection($this->tableGateway->all());
    }

    /**
     * @param string $id
     * @return UserModel::class
     **/
    public function find($id)
    {
        return $this->map($this->tableGateway->findByUser($id));
    }

    /**
     * @param UserModel $user
     * @return bool
     **/
    public function update(UserModel $user)
    {
        return $this->tableGateway->updateWhere(['user_id'=>$user->id], $this->mapUserOnTable($user));
    }

    /**
     * @param UserModel $user
     * @return int
     **/
    public function store(UserModel $user)
    {
        return $this->tableGateway->insert($this->mapUserOnTable($user));
    }

    /**
     * @param $result
     * @return UserModel::class
     **/
    public function map($result)
    {
        $user = $this->model;
        $user->id = $result->id;
        $user->fName = $result->fName;
        $user->lName = $result->lName;
        $user->email = $result->email;
        $user->password = $result->password;
        $user->access_token = $result->access_token;
        $user->fax = $result->fax;
        $user->phone = $result->phone;
        $user->mobile = $result->mobile;
        $user->country = $result->country;
        $user->membershipPlan = $result->membershipPlan;
        $user->membershipStatus = $result->membershipStatus;
        $user->agencies = $result->agencies;
        $user->createdAt = $result->createdAt;
        $user->updatedAt = $result->updatedAt;
        return $user;
    }


    private function mapUserOnTable(UserModel $user)
    {
        return [
            'user_id' => $user->id,
            'json' => $user->toJson(),
            'updated_at' => $user->updatedAt,
            'created_at' => $user->createdAt,
        ];
    }
}
