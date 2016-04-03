<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 3/16/2016
 * Time: 9:57 AM
 */

namespace App\Repositories\Repositories\Sql;


use App\Events\Events\User\UserCreated;
use App\Models\Sql\UserDocument;
use App\Models\Sql\UserJson;
use App\Repositories\Interfaces\Repositories\UsersJsonRepoInterface;
use App\Repositories\Interfaces\Repositories\UsersRepoInterface;
use App\Models\Sql\User;
use App\Repositories\Transformers\Sql\UserJsonTransformer;
use App\Repositories\Transformers\Sql\UserTransformer;
use Illuminate\Support\Facades\Event;

class UsersJsonRepository extends SqlRepository implements UsersJsonRepoInterface
{
    private $userJsonTransformer;
    private $factory = null;
    public function __construct(){
        $this->userJsonTransformer = new UserJsonTransformer();
        $this->factory = new UserDocument();
    }

    public function all()
    {

    }

    public function search()
    {

    }

    public function find($id)
    {

    }

    public function store($user)
    {

    }

    public function update($user)
    {

    }

    public function delete($id)
    {

    }
}
