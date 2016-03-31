<?php

namespace App\Listeners\Listeners\User;

use App\Events\Events\User\UserCreated;
use App\Libs\Json\Creators\Creators\User\UserBasicInfoJsonCreator;
use App\Listeners\Interfaces\ListenerInterface;
use App\Listeners\Listeners\Listener;
use App\Repositories\Repositories\Sql\UsersJsonRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateUserBasicInfoJsonDocument extends Listener implements ListenerInterface
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
     * @param  UserCreated  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        $jsonCreator = new UserBasicInfoJsonCreator($event->user);
        $userBasicInfoJson = $jsonCreator->create();
        dd($userBasicInfoJson);
    }
}
