<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 3/16/2016
 * Time: 9:57 AM
 */

namespace App\Repositories\Repositories\Sql;

use App\Models\Sql\Agency;
use App\Repositories\Interfaces\Repositories\AgenciesRepoInterface;
use Illuminate\Foundation\Auth\User;

class AgenciesRepository extends SqlRepository implements AgenciesRepoInterface
{
    public function __construct(){

    }

    public function getById($id)
    {
        return $this->factory->find($id);
    }

    public function storeAgency($agencyInfo, $userId)
    {
        $agencyInfo['user_id'] = $userId;
        $agency = Agency::create($agencyInfo);
        return ($agency == null)?null:$agency->id;
    }

}
