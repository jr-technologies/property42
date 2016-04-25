<?php

namespace App\Providers;

use App\Events\Events\Agency\AgencyCreated;
use App\Events\Events\Agency\AgencyDeleted;
use App\Events\Events\Agency\AgencyUpdated;
use App\Events\Events\User\UserBasicInfoUpdated;
use App\Events\Events\User\UserCreated;
use App\Listeners\Listeners\Agency\AddNewAgencyInUserJson;
use App\Listeners\Listeners\Agency\DeleteAgencyInUserJson;
use App\Listeners\Listeners\Agency\UpdateAgencyInUserJson;
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
        UserCreated::class=> [
            CreateUserJsonDocument::class,
        ],
        UserBasicInfoUpdated::class => [
            UpdateUserBasicInfoJsonDocument::class
        ],
        AgencyCreated::class => [
            AddNewAgencyInUserJson::class
        ],
        AgencyUpdated::class=> [
            UpdateAgencyInUserJson::class,
        ],
        AgencyDeleted::class=> [
            DeleteAgencyInUserJson::class,
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
