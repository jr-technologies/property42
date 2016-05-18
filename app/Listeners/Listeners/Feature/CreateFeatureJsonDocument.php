<?php
/**
 * Created by PhpStorm.
 * User: WAQAS
 * Date: 5/17/2016
 * Time: 11:50 AM
 */

namespace App\Listeners\Listeners\Feature;


use App\Events\Events\Feature\FeatureJsonCreated;
use App\Libs\Json\Creators\Creators\Feature\SectionFeaturesJsonCreator;
use App\Libs\Json\Creators\Creators\Feature\SectionsFeaturesJsonCreator;
use App\Listeners\Interfaces\ListenerInterface;
use App\Listeners\Listeners\Listener;

class CreateFeatureJsonDocument extends Listener implements ListenerInterface
{
    public function handle(FeatureJsonCreated $event)
    {
        $featureJsonCreator = (new SectionsFeaturesJsonCreator($event->feature))->create();
//        $sectionFeature = new SectionFeaturesJsonCreator($featureJsonCreator);
//        $userJson = $featureJsonCreator->create();
//        return $this->usersJsonRepository->store($userJson);
    }
}