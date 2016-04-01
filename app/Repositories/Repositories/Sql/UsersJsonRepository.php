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
use App\Repositories\Interfaces\Repositories\UsersRepoInterface;
use App\Models\Sql\User;
use App\Repositories\Transformers\Sql\UserJsonTransformer;
use App\Repositories\Transformers\Sql\UserTransformer;
use Illuminate\Support\Facades\Event;

class UsersJsonRepository extends SqlRepository implements UsersRepoInterface
{
    private $userJsonTransformer;
    private $userDocuments = null;
    public function __construct(){
        $this->userJsonTransformer = new UserJsonTransformer();
        $this->userDocuments = new UserDocument();
    }

    public function getFirst(array $where = [])
    {
        $userJson = $this->userDocuments->where($where)->get()->first();
        return $userJson;
    }

    public function update($userJson)
    {
        return $this->userDocuments->update($userJson);
    }

    public function store($userDocument)
    {
        $userDocument = $this->userDocuments->create($userDocument);
        return ($userDocument == null)?null:$userDocument->id;
    }

    public function getByUserId($userId)
    {
        return $this->getFirst(['user_id'=>$userId]);
    }
}
