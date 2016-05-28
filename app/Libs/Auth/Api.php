<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/16/2016
 * Time: 9:55 AM
 */

namespace App\Libs\Auth;


use App\Events\Events\User\UserBasicInfoUpdated;
use App\Libs\Auth\Traits\TokenGenerator;
use App\DB\Providers\SQL\Models\User;
use Illuminate\Support\Facades\Event;

class Api extends Authenticate implements AuthInterface
{
    private $accessToken = null;

    public function __construct(){
        parent::__construct();
    }


    /**
     * @param User $authenticatedUser
     * @return User
     */
    public function login(User $authenticatedUser){
        return parent::login($authenticatedUser);
    }

    public function authenticate()
    {
        try{
            $this->user();
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    public function user()
    {
        return $this->users->getByToken($this->getAccessToken());
    }
    /**
     * @return null
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param null $accessToken
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

}