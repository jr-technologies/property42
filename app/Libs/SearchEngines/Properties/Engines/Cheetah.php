<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 6/9/2016
 * Time: 5:59 AM
 */

namespace App\Libs\SearchEngines\Properties\Engines;


use App\DB\Providers\SQL\Factories\Factories\Block\BlockFactory;
use App\DB\Providers\SQL\Factories\Factories\Property\PropertyFactory;
use App\DB\Providers\SQL\Factories\Factories\PropertyFeatureValue\PropertyFeatureValueFactory;
use App\DB\Providers\SQL\Factories\Factories\PropertyJson\PropertyJsonFactory;
use App\DB\Providers\SQL\Factories\Factories\Society\SocietyFactory;
use App\Libs\Helpers\LandArea;
use App\Libs\SearchEngines\Properties\PropertiesSearchEngineInterface;
use Illuminate\Support\Facades\DB;

class Cheetah extends PropertiesSearchEngine implements PropertiesSearchEngineInterface
{
    private $instructions = [];

    public function go()
    {
        return $this->buildQuery()->get();
    }

    public function setInstructions(array $instructions)
    {
        $this->instructions = $instructions;
        return $this;
    }

    private function buildQuery()
    {
        $properties = (new PropertyFactory())->getTable();
        $societies = (new SocietyFactory())->getTable();
        $blocks = (new BlockFactory())->getTable();
        $propertyJsonTable = (new PropertyJsonFactory())->getTable();
        $propertyFeatureValues = (new PropertyFeatureValueFactory())->getTable();

        $query = DB::table($properties)
            ->join($propertyJsonTable,$properties.'.id','=',$propertyJsonTable.'.property_id')
            ->leftjoin($blocks,$properties.'.block_id','=',$blocks.'.id')
            ->leftjoin($societies,$blocks.'.society_id','=',$societies.'.id')
            ->leftjoin($propertyFeatureValues,$properties.'.id','=',$propertyFeatureValues.'.property_id')
            ->select($propertyJsonTable.'.json');

        if(isset($this->instructions['subTypeId']) && $this->instructions['subTypeId'] != null && $this->instructions['subTypeId'] != '')
            $query = $query->where($properties.'.property_sub_type_id',$this->instructions['subTypeId']);
        else if(isset($this->instructions['societyId']) && $this->instructions['societyId'] != null && $this->instructions['societyId'] != '')
            $query = $query->where($societies.'.id',$this->instructions['societyId']);
        if(isset($this->instructions['blockId']) && $this->instructions['blockId'] != null && $this->instructions['blockId'] != '')
            $query = $query->where($properties.'.block_id',$this->instructions['blockId']);
        if(isset($this->instructions['priceFrom']) && $this->instructions['priceFrom'] != null && $this->instructions['priceFrom'] != '')
            $query = $query->where($properties.'.price','>=',$this->instructions['priceFrom']);
        if(isset($this->instructions['priceTo']) && $this->instructions['priceTo'] != null && $this->instructions['priceTo'] != '')
            $query = $query->where($properties.'.price', '<=', $this->instructions['priceTo']);
        if(isset($this->instructions['landAreaFrom']) && $this->instructions['landAreaFrom'] != null && $this->instructions['landAreaFrom'] != '')
            $query = $query->where($properties.'.land_area', '>=', LandArea::convert(config('constants.LAND_UNITS')[$this->instructions['landUnitId']], 'square feet',$this->instructions['landAreaFrom']));
        if(isset($this->instructions['landAreaTo']) && $this->instructions['landAreaTo'] != null && $this->instructions['landAreaTo'] != '')
            $query = $query->where($properties.'.land_area', '<=', LandArea::convert($this->instructions['landUnitId'], 'square feet',$this->instructions['landAreaTo']));

        foreach($this->instructions['propertyFeatures'] as $key => $value){
            if($value != '' && $value != null){
                $query = $query->where([
                    $propertyFeatureValues.'.property_feature_id' => $key,
                    $propertyFeatureValues.'.value' => $value
                ]);
            }
        }
        $sorting = $this->computeSorting();
        $query = $query->orderBy($sorting['sortBy'],$sorting['order']);
        $query = $query->skip($this->computePagination()['start'])->take($this->computePagination()['limit']);
        $query = $query->distinct();

        return $query;
    }

    private function computeSorting()
    {
        return [
            'sortBy' => $this->getSortableColumnValue($this->instructions['sortBy']),
            'order' => $this->getOrder()
        ];
    }

    private function computePagination()
    {
        $pagination = [
            'start' => 0,
            'limit' => config('constants.PROPERTIES_LIMIT')
        ];
        if(isset($this->instructions['page']) ){
            $page = intval($this->instructions['page']);
            $page = ($page < 1)?1: $page;
            $limit = intval($this->instructions['limit']);
            $limit = ($limit < 1)?config('constants.PROPERTIES_LIMIT'):$limit;
            $start = $limit*($page-1);

            $pagination['start'] = $start;
            $pagination['limit'] = $limit;
        }
        return $pagination;
    }

    private function defaultSorting()
    {
        return [
            'sortBy' => 'total_views',
            'order' => 'desc'
        ];
    }

    private function getSortableColumns()
    {
        return [
            'id' => 'properties.id',
            'type' => 'property_types.type',
        ];
    }

    private function getSortableColumnValue($column)
    {
        if(isset($this->getSortableColumns()[$column]))
        {
            return $this->getSortableColumns()[$column];
        }
        return $this->defaultSorting()['sortBy'];
    }

    private function getOrder()
    {
        if(isset($this->instructions['order']) && ($this->instructions['order'] == 'desc' || $this->instructions['order'] == 'asc'))
        {
            return $this->instructions['order'];
        }
        return 'desc';
    }

}