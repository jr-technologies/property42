<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 3/16/2016
 * Time: 9:57 AM
 */

namespace App\Repositories\Repositories\Sql;


use App\Events\Events\User\UserCreated;
use App\Models\Sql\UserJson;
use App\Repositories\Interfaces\Repositories\UsersRepoInterface;
use App\Models\Sql\User;
use App\Repositories\Transformers\Sql\UserJsonTransformer;
use App\Repositories\Transformers\Sql\UserTransformer;
use Illuminate\Support\Facades\Event;

class UsersJsonRepository extends SqlRepository implements UsersRepoInterface
{
    private $userJsonTransformer;
    public function __construct(){
        $this->userJsonTransformer = new UserJsonTransformer();
    }

    public function getFirst(array $where = [])
    {
        $userJson = UserJson::where($where)->get()->first();
        return $this->userJsonTransformer->transform($userJson);
    }

    public function update($userJson)
    {
        return true;
    }

    public function store($userId, $userJson)
    {
        $userJson = UserJson::create(['user_id' => $userId, 'json'=>$userJson]);
        return ($userJson == null)?null:$userJson->id;
    }

    public function deleteUser($userId)
    {
        User::destroy($userId);
        return true;
    }

    public function getUserDocument($userId)
    {
        $user = User::where('id','=',$userId)->with('document')->get()->first();
        return ($user->document == null)?null:$this->userTransformer->transform($user->document->decode());
    }
}
