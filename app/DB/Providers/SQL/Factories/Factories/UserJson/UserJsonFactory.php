<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/1/2016
 * Time: 9:34 PM
 */

namespace App\DB\Providers\SQL\Factories\Factories\UserJson;

use App\DB\Providers\SQL\Factories\Factories\UserJson\Gateways\UserJsonQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\Libs\Json\Prototypes\Prototypes\User\UserJsonPrototype;

class UserJsonFactory extends SQLFactory implements SQLFactoriesInterface{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new UserJsonPrototype();
        $this->tableGateway = new UserJsonQueryBuilder();
    }


    /**
     * @return array UserModel::class
     **/
    public function all()
    {
        return $this->mapCollection($this->tableGateway->all());
    }
    public function getStaffByOwner($agencyId)
    {
        return $this->mapCollection($this->tableGateway->getStaffByOwner($agencyId));
    }
    /**
     * @param int $id
     * @return UserJsonPrototype::class
     **/
    public function find($id)
    {
        return $this->map($this->tableGateway->findByUser($id));
    }
    public function search($params)
    {
        return $this->mapCollection($this->tableGateway->search($params));
    }

    /**
     * @param UserJsonPrototype $user
     * @return bool
     **/
    public function update(UserJsonPrototype $user)
    {
        return $this->tableGateway->updateWhere(['user_id'=>$user->id], $this->mapUserOnTable($user));
    }

    /**
     * @param UserJsonPrototype $user
     * @return int
     **/
    public function store(UserJsonPrototype $user)
    {
        return $this->tableGateway->insert($this->mapUserOnTable($user));
    }

    /**
     * @param $result
     * @return UserJsonPrototype::class
     **/
    public function map($result)
    {
        /* @var $userJson UserJsonPrototype */
        $userJson = json_decode($result->json);
        $user = $this->model;
        $user->id = $userJson->id;
        $user->fName = $userJson->fName;
        $user->lName = $userJson->lName;
        $user->email = $userJson->email;
        $user->fax = $userJson->fax;
        $user->phone = $userJson->phone;
        $user->mobile = $userJson->mobile;
        $user->country = $userJson->country;
        $user->membershipPlan = $userJson->membershipPlan;
        $user->roles = $userJson->roles;
        $user->agencies = $userJson->agencies;
        $user->createdAt = $userJson->createdAt;
        $user->updatedAt = $userJson->updatedAt;
        return $user;
    }


    private function mapUserOnTable(UserJsonPrototype $user)
    {
        return [
            'user_id' => $user->id,
            'json' => $user->encode(),
            'updated_at' => $user->updatedAt,
            'created_at' => $user->createdAt,
        ];
    }
}
