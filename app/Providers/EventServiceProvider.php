<?php

namespace App\Providers;

use App\Events\Events\Agency\AgencyCreated;
use App\Events\Events\Agency\AgencyDeleted;
use App\Events\Events\Agency\AgencyUpdated;
use App\Events\Events\Feature\FeatureJsonCreated;
use App\Events\Events\Property\PropertyCreated;
use App\Events\Events\Property\PropertyDeleted;
use App\Events\Events\Property\PropertyUpdated;
use App\Events\Events\Section\SectionUpdated;
use App\Events\Events\User\UserBasicInfoUpdated;
use App\Events\Events\User\UserCreated;
use App\Events\Events\User\UserRolesChanged;
use App\Listeners\Listeners\Agency\AddNewAgencyInUserJson;
use App\Listeners\Listeners\Agency\AddOwnerAsStaffMember;
use App\Listeners\Listeners\Agency\DeleteAgencyInUserJson;
use App\Listeners\Listeners\Agency\UpdateAgencyInUserJson;
use App\Listeners\Listeners\Feature\CreateFeatureJsonDocument;
use App\Listeners\Listeners\Property\CreatePropertyJsonDocument;
use App\Listeners\Listeners\Property\DeletePropertyJsonDocument;
use App\Listeners\Listeners\Property\UpdatePropertyJsonDocument;
use App\Listeners\Listeners\Section\RegenerateSectionFeaturesJson;
use App\Listeners\Listeners\User\UpdateUserBasicInfoJsonDocument;
use App\Listeners\Listeners\User\CreateUserJsonDocument;
use App\Listeners\Listeners\User\UpdateUserRoleInUserJson;
use App\Traits\AssignedFeaturesJsonDocumentsGenerator;
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
        
        /* agency events */
        AgencyCreated::class => [
            AddNewAgencyInUserJson::class,
			 AddOwnerAsStaffMember::class
        ],
        AgencyUpdated::class => [
            UpdateAgencyInUserJson::class,
        ],
        AgencyDeleted::class => [
            DeleteAgencyInUserJson::class,
        ],
        
        /* property events */
        PropertyCreated::class => [
            CreatePropertyJsonDocument::class,
        ],
        PropertyUpdated::class => [
            UpdatePropertyJsonDocument::class,
        ],
        PropertyDeleted::class => [
            DeletePropertyJsonDocument::class,
        ],
        FeatureJsonCreated::class => [
            CreateFeatureJsonDocument::class,
        ],
        SectionUpdated::class => [
            RegenerateSectionFeaturesJson::class,
        ],
        UserRolesChanged::class => [
            UpdateUserRoleInUserJson::class,
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
