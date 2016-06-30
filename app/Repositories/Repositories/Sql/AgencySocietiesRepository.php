<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/16/2016
 * Time: 9:57 AM
 */

namespace App\Repositories\Repositories\Sql;

use App\DB\Providers\SQL\Factories\Factories\AgencySociety\AgencySocietyFactory;
use App\Repositories\Interfaces\Repositories\AgenciesRepoInterface;

class AgencySocietiesRepository extends SqlRepository implements AgenciesRepoInterface
{
    private $factory = null;
    public function __construct(){
        $this->factory = new AgencySocietyFactory();
    }

    public function update($agencyId, array $societyIds)
    {

    }

    public function get($agencyId)
    {
        return $this->factory->get($agencyId);
    }
}
