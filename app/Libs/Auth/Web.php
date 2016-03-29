<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 3/16/2016
 * Time: 9:55 AM
 */

namespace App\Libs\Auth;


class Web extends Authenticate implements AuthInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login(array $credentials){
        return $this->users->getFirst($credentials);
    }

    public function authenticate()
    {
        return ($this->user() == null)?false: true;
    }

    public function user()
    {
        return (object)['email'=>'waqas@gamil.com'];
    }
}