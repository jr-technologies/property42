<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
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
    use TokenGenerator;

    private $accessToken = null;

    public function __construct(){
        parent::__construct();
    }


    /**
     * @param User $authenticatedUser
     * @return User
     */
    public function login(User $authenticatedUser){
        $authenticatedUser->access_token = $this->generateToken($authenticatedUser->id);
        $this->users->update($authenticatedUser);
        //Event::fire(new UserBasicInfoUpdated($authenticatedUser));
        return $authenticatedUser;
    }

    public function authenticate()
    {
        return ($this->user() == null)?false: true;
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