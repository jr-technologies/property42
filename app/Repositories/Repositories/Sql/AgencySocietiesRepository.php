<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/16/2016
 * Time: 9:57 AM
 */

namespace App\Repositories\Repositories\Sql;

use App\DB\Providers\SQL\Factories\Factories\AgencySociety\AgencySocietyFactory;
use App\DB\Providers\SQL\Models\AgencySociety;
use App\Libs\Helpers\Helper;
use App\Repositories\Interfaces\Repositories\AgenciesRepoInterface;

class AgencySocietiesRepository extends SqlRepository implements AgenciesRepoInterface
{
    private $factory = null;
    public function __construct(){
        $this->factory = new AgencySocietyFactory();
    }

    public function update($agencyId, array $societyIds)
    {
        $existingAgencyIds = Helper::propertyToArray($this->get($agencyId), 'societyId');
        $newSocietyIds = array_diff($societyIds,$existingAgencyIds);
        $deletingSocietyIds = array_diff($existingAgencyIds,$societyIds);
        $newSocietiesModels = [];
        foreach($newSocietyIds as $newSocietyId){
            $agencySociety = new AgencySociety();
            $agencySociety->agencyId = $agencyId;
            $agencySociety->societyId = $newSocietyId;
            $newSocietiesModels[] = $agencySociety;
        }
        $this->storeMultiple($newSocietiesModels);
        $this->deleteAgencySocieties($agencyId, $deletingSocietyIds);
    }

    public function storeMultiple(array $agencySocieties)
    {
        return $this->factory->addSocieties($agencySocieties);
    }

    public function deleteAgencySocieties($agencyId, array $societyIds)
    {
        $this->factory->deleteAgencySocieties($agencyId, $societyIds);
    }

    public function get($agencyId)
    {
        return $this->factory->get($agencyId);
    }
}
