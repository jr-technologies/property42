<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 3/16/2016
 * Time: 9:57 AM
 */

namespace App\Repositories\Repositories\Sql;


use App\Collections\Collections\UserCollection;
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

    public function getWithRelations(array $where = [])
    {
        return  $this->users->where($where)
                ->with('country')
                ->with('membershipPlan')
                ->with('agencies')
                ->get();
    }
    public function getFirstWithRelations(array $where = [])
    {
        $user = $this->getWithRelations($where)->first();
        return $this->userTransformer->transform($user);
    }

    public function getById($id)
    {
        return $this->getFirstWithRelations(['id'=>$id]);
    }

    public function getByToken($token)
    {
        return $this->getFirstWithRelations(['access_token'=>$token]);
    }

    public function getByCredentials(array $credentials)
    {
        return $this->getFirstWithRelations($credentials);
    }

    public function all()
    {
        $users = $this->getWithRelations()->all();
        return new UserCollection($this->userTransformer->transformCollection($users));
    }

    public function update($id, $info)
    {
        return $this->users->where('id','=',$id)->update($info);
    }

    public function store($userInfo)
    {
        $user = $this->users->create($userInfo);
        Event::fire(new UserCreated($this->getById($user->id)));
        return ($user == null)?null:$user->id;
    }

    public function delete($userId)
    {
        $this->users->destroy($userId);
        return true;
    }
}
