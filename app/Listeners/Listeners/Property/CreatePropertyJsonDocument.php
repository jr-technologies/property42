<?php

namespace App\Listeners\Listeners\Property;

use App\Events\Events\Property\PropertyCreated;
use App\Libs\Json\Creators\Creators\Property\PropertyJsonCreator;
use App\Listeners\Interfaces\ListenerInterface;
use App\Listeners\Listeners\Listener;

class CreatePropertyJsonDocument extends Listener implements ListenerInterface
{
    private $propertiesJsonRepository = null;

    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  PropertyCreated  $event
     * @return bool
     */
    public function handle(PropertyCreated $event)
    {
        $propertyJsonCreator = new PropertyJsonCreator($event->property);
        $propertyJson = $propertyJsonCreator->create();
        return $this->propertiesJsonRepository->store($propertyJson);
    }
}
