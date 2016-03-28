<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 3/25/2016
 * Time: 11:39 AM
 */

namespace App\Libs\Json\Creators\Creators;


use App\Libs\Json\Creators\Interfaces\JsonCreatorInterface;
use App\Libs\Json\Prototypes\Prototypes\UserJsonPrototype;
use App\Models\Sql\User;

class UserJsonCreator extends JsonCreator implements JsonCreatorInterface
{
    private $user = null;
    private $prototype = null;
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->prototype = new UserJsonPrototype($this->user);
    }

    public function create()
    {
        return $this->prototype->prototype();
    }
}