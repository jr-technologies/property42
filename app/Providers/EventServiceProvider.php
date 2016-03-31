<?php

namespace App\Providers;

use App\Listeners\Listeners\User\UpdateUserBasicInfoJsonDocument;
use App\Listeners\Listeners\User\CreateUserJsonDocument;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Events\User\UserCreated' => [
            CreateUserJsonDocument::class,
        ],
        'App\Events\Events\User\UserBasicInfoUpdated' => [
            UpdateUserBasicInfoJsonDocument::class
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
