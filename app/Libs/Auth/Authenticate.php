<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 3/17/2016
 * Time: 12:08 PM
 */

namespace App\Libs\Auth;


use App\Models\Sql\User;
use App\Repositories\Repositories\Sql\UsersRepository;
use Illuminate\Support\Facades\Hash;

abstract class Authenticate
{
    public $users = null;
    public function __construct()
    {
        $this->users = new UsersRepository();
    }

    public function attempt(array $credentials)
    {
        $user = $this->users->findByEmail($credentials['email']);
        if(!$user)
            return false;

        if(!Hash::check($credentials['password'], $user->password))
            return false;

        return true;
    }
}