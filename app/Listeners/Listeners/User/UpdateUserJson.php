<?php

namespace App\Listeners\Listeners\User;

use App\Events\Events\User\UserBasicInfoUpdated;
use App\Events\Events\User\UserUpdated;
use App\Libs\Json\Creators\Creators\User\UserBasicInfoJsonCreator;
use App\Libs\Json\Creators\Creators\User\UserJsonCreator;
use App\Libs\Json\Prototypes\Prototypes\User\UserBasicInfoJsonPrototype;
use App\Libs\Json\Prototypes\Prototypes\User\UserJsonPrototype as User;
use App\Listeners\Interfaces\ListenerInterface;
use App\Listeners\Listeners\Listener;
use App\Repositories\Repositories\Sql\UsersJsonRepository;

class UpdateUserJson extends Listener implements ListenerInterface
{
    private $usersJsonRepository = null;
    /**
     * @param UsersJsonRepository $usersJsonRepository
     * Create the event listener.
     */
    public function __construct(UsersJsonRepository $usersJsonRepository)
    {
        $this->usersJsonRepository = $usersJsonRepository;
    }

    /**
     * Handle the event.
     *
     * @param  UserUpdated  $event
     * @return void
     */
    public function handle(UserUpdated $event)
    {
        $jsonCreator = new UserJsonCreator($event->user);
        $userJson = $jsonCreator->create();
        $this->usersJsonRepository->update($userJson);
    }

    public function map(UserBasicInfoJsonPrototype $userBasicInfo , User $userObject)
    {
        $userObject->fName = $userBasicInfo->fName;
        $userObject->lName = $userBasicInfo->lName;
        $userObject->email = $userBasicInfo->email;
        $userObject->phone = $userBasicInfo->phone;
        $userObject->mobile = $userBasicInfo->mobile;
        $userObject->address = $userBasicInfo->address;
        $userObject->zipCode = $userBasicInfo->zipCode;
        return $userObject;
    }
}
