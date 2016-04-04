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
use App\DB\Providers\SQL\SQLFactoryProvider;
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
        $this->factory = SQLFactoryProvider::user();
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


    /**
     * @param string $column
     * @param string $value
     * @return User
     */
    public function findBy($column, $value)
    {
        return $this->factory->findBy($column, $value);
    }

    /**
     * @param string $email
     * @return User
     */
    public function findByEmail($email = "")
    {
        return $this->factory->findByEmail($email);
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
        return $this->factory->findWhere($credentials);
    }

    public function all()
    {
        $users = $this->factory->all();
        return new UserCollection($users);
    }

    public function update(User $user)
    {
        return $this->factory->update($user);
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
