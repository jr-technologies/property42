<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 3/16/2016
 * Time: 9:57 AM
 */

namespace App\Repositories\Repositories\Sql;


use App\Events\Events\User\UserCreated;
use App\Libs\Json\Creators\Creators\UserJsonCreator;
use App\Repositories\Interfaces\Repositories\UsersRepoInterface;
use App\Models\Sql\User;
use App\Repositories\Transformers\Sql\UserTransformer;
use Illuminate\Support\Facades\Event;

class UsersRepository extends SqlRepository implements UsersRepoInterface
{
    private $userTransformer;
    public function __construct(){
        $this->userTransformer = new UserTransformer();
    }

    public function getFirst(array $where = [])
    {
        $user = User::where($where)->with('document')->get()->first();
        return ($user->document->json == null)?null:$this->userTransformer->transform($user->document->decode());
    }

    public function getById($id)
    {
        return $this->getFirst(['id'=>$id]);
    }

    public function getByToken($token)
    {
        return $this->getFirst(['access_token'=>$token]);
    }

    public function update($id, $info)
    {
        return User::where('id','=',$id)->update($info);
    }

    public function store($userInfo)
    {
        $user = User::create($userInfo);
        Event::fire(new UserCreated($this->fetchUserWithRelations($user->id)));
        return ($user == null)?null:$user->id;
    }

    public function delete($userId)
    {
        User::destroy($userId);
        return true;
    }

    public function getUserDocument($userId)
    {
        $user = User::where('id','=',$userId)->with('document')->get()->first();
        return ($user->document == null)?null:$this->userTransformer->transform($user->document->decode());
    }

    public function fetchUserWithRelations($userId)
    {
        $user = User::where('id','=', $userId)
            ->with('country')
            ->with('membershipPlan')
            ->with('agencies')
            ->get()->first();
        return $user;
    }
}
