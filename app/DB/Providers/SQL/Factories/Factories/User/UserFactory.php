<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/1/2016
 * Time: 9:34 PM
 */

namespace App\DB\Providers\SQL\Factories\Factories\User;

use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Factories\Factories\User\Gateways\UserQueryBuilder;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\User as UserModel;

class UserFactory extends SQLFactory implements SQLFactoriesInterface{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new UserModel();
        $this->tableGateway = new UserQueryBuilder();
    }

    /**
     * @param string $token
     * @return UserModel::class
     **/
    public function findByToken($token)
    {
        return $this->map($this->tableGateway->findBy('access_token', $token));
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
        return $this->map($this->tableGateway->find($id));
    }

    /**
     * @param UserModel $user
     * @return bool
     **/
    public function update(UserModel $user)
    {
        return $this->tableGateway->update($user->id, $this->mapUserOnTable($user));
    }

    /**
     * @param array $where
     * @param array $data
     * @return bool
     **/
    public function updateWhere(array $where, array $data)
    {
        return $this->tableGateway->updateWhere($where, $data);
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
        $user->fName = $result->f_name;
        return $user;
    }


    private function mapUserOnTable(UserModel $user)
    {
        return [
            'f_name' => $user->fName,
            'l_name' => $user->lName,
            'email' => $user->email,
            'password' => $user->password,
            'country_id' => $user->countryId,
            'membership_plan_id' => $user->membershipPlanId
        ];
    }
}
