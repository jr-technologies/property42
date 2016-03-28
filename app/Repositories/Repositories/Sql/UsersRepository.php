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
    private $users = null;
    public function __construct(){
        $this->userTransformer = new UserTransformer();
        $this->users = new User();
    }

    public function getFirst(array $where = [])
    {
        $user = $this->users->where($where)->with('document')->get()->first();
        if($user == null || $user->document == null)
            return null;

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

    public function all()
    {
        return $this->users->with('country')
                ->with('membershipPlan')
                ->with('agencies')
                ->get();
    }
    public function update($id, $info)
    {
        return $this->users->where('id','=',$id)->update($info);
    }

    public function store($userInfo)
    {
        $user = $this->users->create($userInfo);
        Event::fire(new UserCreated($this->fetchUserWithRelations($user->id)));
        return ($user == null)?null:$user->id;
    }

    public function delete($userId)
    {
        $this->users->destroy($userId);
        return true;
    }

    public function getUserDocument($userId)
    {
        $user = $this->users->where('id','=',$userId)->with('document')->get()->first();
        return ($user->document == null)?null:$this->userTransformer->transform($user->document->decode());
    }

    public function fetchUserWithRelations($userId)
    {
        $user = $this->users->where('id','=', $userId)
            ->with('country')
            ->with('membershipPlan')
            ->with('agencies')
            ->get()->first();
        return $user;
    }
}
