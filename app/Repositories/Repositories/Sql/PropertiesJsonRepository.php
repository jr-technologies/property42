<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/16/2016
 * Time: 9:57 AM
 */

namespace App\Repositories\Repositories\Sql;


class PropertiesJsonRepository extends SqlRepository implements PropertiesJsonRepoInterface
{
    private $userJsonTransformer;
    private $factory = null;
    public function __construct(){
        $this->userJsonTransformer = new PropertyJsonTransformer();
        $this->factory = new UserJsonFactory();
    }

    public function all()
    {

    }

    public function search()
    {

    }

    public function find($id)
    {
        return $this->factory->find($id);
    }

    public function store(UserJsonPrototype $user)
    {
        return $this->factory->store($user);
    }

    public function update($user)
    {
        return $this->factory->update($user);
    }

    public function delete($id)
    {

    }
}
