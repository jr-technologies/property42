<?php
/**
 * Created by PhpStorm.
 * User: WAQAS
 * Date: 5/17/2016
 * Time: 11:32 AM
 */

namespace App\Libs\Json\Creators\Creators\Feature;


use App\Libs\Json\Creators\Creators\JsonCreator;
use App\Libs\Json\Creators\Interfaces\JsonCreatorInterface;

class SectionsFeaturesJsonCreator extends JsonCreator implements JsonCreatorInterface
{
    public $features = [];
    public function __construct(array $features)
    {
        $this->features = $features;
    }
    public function create()
    {
        $features = $this->features;
            $collection = collect($features);
            $collection = $collection->each(function ($item, $key) {
            $item->sectionName = $item->section->name;
        });

        $groupedBySection = $collection->groupBy('sectionName');
        $finalArray = [];
        $groupedBySection->each(function($featuresCollection,$key) use (&$finalArray){
            $features = $featuresCollection->all();
            $section = clone($features[0]->section);
            $section->features = $features;
            $finalArray[$key] = (new SectionFeaturesJsonCreator($section))->create();
        });
    }
}