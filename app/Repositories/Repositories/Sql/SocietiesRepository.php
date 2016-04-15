<?php
/**
 * Created by WAQAS.
 * User: JR Tech
 * Date: 4/7/2016
 * Time: 11:14 AM
 */

namespace App\Repositories\Repositories\Sql;


use App\DB\Providers\SQL\Factories\Factories\Society\SocietyFactory;
use App\DB\Providers\SQL\Models\Society;
use App\Repositories\Interfaces\Repositories\SocietiesRepoInterface;

class SocietiesRepository extends SqlRepository implements SocietiesRepoInterface
{
    private $factory;
    public function __construct()
    {
         $this->factory = new SocietyFactory();
    }
    public function store(Society $society)
    {
        return $this->factory->store($society);
    }


    public function getById($id)
    {
        return $this->factory->find($id);
    }

    public function all()
    {
        return $this->factory->all();
    }

    public function update(Society $society)
    {
        $this->factory->update($society);
        return $this->factory->find($society->id);
    }

    public function delete(Society $society)
    {
        return $this->factory->delete($society);
    }
}