<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/1/2016
 * Time: 9:34 PM
 */

namespace App\DB\Providers\SQL\Factories\Factories\Agency;

use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Factories\Factories\Agency\Gateways\AgencyQueryBuilder;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\Agency;

class AgencyFactory extends SQLFactory implements SQLFactoriesInterface{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new Agency();
        $this->tableGateway = new AgencyQueryBuilder();
    }

    /**
     * @return array Agency::class
     **/
    public function all()
    {
        return $this->mapCollection($this->tableGateway->all());
    }

    /**
     * @param string $id
     * @return Agency::class
     **/
    public function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }

    /**
     * @param string $userId
     * @description: function returns multiple instances of Agency Model
     * @return Agency::class
     **/
    public function getByUser($userId)
    {
        return $this->mapCollection($this->tableGateway->getBy('user_id', $userId));
    }

    /**
     * @param Agency $agency
     * @return bool
     **/
    public function update(Agency $agency)
    {
        return $this->tableGateway->update($agency->id, $this->mapCountryOnTable($agency));
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
     * @param Agency $agency
     * @return int
     **/
    public function store(Agency $agency)
    {
        return $this->tableGateway->insert($this->mapCountryOnTable($agency));
    }

    /**
     * @param $result
     * @return Agency::class
     **/
    public function map($result)
    {
        $agency = $this->model;
        $agency->id = $result->id;
        $agency->userId = $result->user_id;
        $agency->name = $result->agency;
        $agency->description = $result->description;
        $agency->address = $result->address;
        $agency->mobile = $result->mobile;
        $agency->phone = $result->phone;
        $agency->email = $result->email;
        $agency->updatedAt = $result->updated_at;
        $agency->createdAt = $result->created_at;
        return $agency;
    }


    private function mapCountryOnTable(Agency $agency)
    {
        return [
            'id' => $agency->id,
            'user_id' => $agency->userId,
            'agency' => $agency->name,
            'description' => $agency->description,
            'address' => $agency->address,
            'phone' => $agency->phone,
            'email' => $agency->email,
            'mobile' => $agency->mobile,
            'updated_at' => $agency->updatedAt,
        ];
    }
}
