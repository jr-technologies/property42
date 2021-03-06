<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/16/2016
 * Time: 9:57 AM
 */

namespace App\Repositories\Repositories\Sql;

use App\DB\Providers\SQL\Factories\Factories\Agency\AgencyFactory;
use App\DB\Providers\SQL\Models\Agency;
use App\Events\Events\Agency\AgencyCreated;
use App\Events\Events\Agency\AgencyDeleted;
use App\Events\Events\Agency\AgencyUpdated;
use App\Repositories\Interfaces\Repositories\AgenciesRepoInterface;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Event;

class AgenciesRepository extends SqlRepository implements AgenciesRepoInterface
{
    private $factory = null;
    public function __construct(){
        $this->factory = new AgencyFactory();
    }

    public function getById($id)
    {
        return $this->factory->find($id);
    }

    /**
     * @param int $userId
     * @description: function will return all the agencies
     * of specified userId.
     * @return array Agency::class
     */
    public function getByUser($userId)
    {
        return $this->factory->getByUser($userId);
    }

    public function storeAgency(Agency $agency)
    {
        $agency->id = $this->factory->store($agency);
        Event::fire(new AgencyCreated($agency));
        return $agency->id;
    }

    public function addCities($agencyId, $cityIds)
    {
        return $this->factory->addCities($agencyId, $cityIds);
    }
    public function updateAgency(Agency $agency)
    {
        $this->factory->update($agency);
        Event::fire(new AgencyUpdated($agency));
        return $this->factory->find($agency->id);
    }

    /**
     * @param Agency $agency
     * @return mixed
     */
    public function deleteAgency(Agency $agency)
    {
        $agency = $this->factory->delete($agency);
        Event::fire(new AgencyDeleted($agency));
        return $agency;
    }
    public function getUserAgency($userId)
    {
        return $this->factory->getUserAgency($userId);
    }

}
