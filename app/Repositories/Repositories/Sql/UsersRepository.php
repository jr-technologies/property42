<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 3/16/2016
 * Time: 9:57 AM
 */

namespace App\Repositories\Repositories\Sql;


use App\Collections\Collections\UserCollection;
use App\DB\Providers\SQL\Factories\Factories\User\UserFactory;
use App\Events\Events\User\UserCreated;
use App\Libs\Json\Creators\Creators\UserJsonCreator;
use App\Repositories\Interfaces\Repositories\UsersRepoInterface;
use App\DB\Providers\SQL\Models\User;
use App\Repositories\Transformers\Sql\UserTransformer;
use Illuminate\Support\Facades\Event;

class UsersRepository extends SqlRepository implements UsersRepoInterface
{
    private $userTransformer;
    private $factory = null;
    public function __construct(){
        $this->userTransformer = new UserTransformer();
        $this->factory = new UserFactory();
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
        return $this->factory->find($id);
    }

    public function getByToken($token)
    {
        return $this->factory->findByToken($token);
    }

    public function getByCredentials(array $credentials)
    {
        return $this->getFirstWithRelations($credentials);
    }

    public function all()
    {
        $users = $this->factory->all();
        return new UserCollection($this->userTransformer->transformCollection($users));
    }

    public function update($id, $info)
    {
        return $this->users->where('id','=',$id)->update($info);
    }

    public function store(User $user)
    {
        $user->id = $this->factory->store($user);
        Event::fire(new UserCreated($user));
        return $user->id;
    }

    public function delete($userId)
    {
        $this->users->destroy($userId);
        return true;
    }
}
