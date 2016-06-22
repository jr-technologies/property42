<?php
namespace App\DB\Providers\SQL\Factories\Factories\Society\Gateways;
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/6/2016
 * Time: 10:07 AM
 */
use App\DB\Providers\SQL\Factories\Factories\AgencySociety\AgencySocietyFactory;
use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use Illuminate\Support\Facades\DB;

class SocietyQueryBuilder extends QueryBuilder
{
    public function __Construct()
    {
        $this->table = 'societies';
    }

    public function getSocietiesByAgency($agencyId)
    {
       $agencySociety = (new AgencySocietyFactory())->getTable();

      return DB::table($agencySociety)
            ->leftjoin($this->table,$agencySociety.'.society_id','=',$this->table.'.id')
            ->select($this->table.'.*')
            ->where($agencySociety.'.agency_id','=',$agencyId)
            ->get();
    }
}