<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 10:17 AM
 **/

namespace App\DB\Providers\SQL\Models\Features;

class FeatureHtmlStructure {
    public $id = 0;
    public $name = "";
    public $html = "";
    private $featureInputName = "";
    public function setHtml($featureInputName)
    {
        $this->featureInputName = $featureInputName;
        $this->html = $this->createHtml();
    }

    private function createHtml()
    {
        switch($this->name)
        {
            case 'text':
                return $this->createSelect();
                break;
            case 'number':
                return $this->createNumber();
                break;
            default:
                return $this->createText();
        }
    }

    private function createText()
    {
        return "<input type='text' name='".$this->featureInputName."' ng-model='\$parent.data.features.".$this->featureInputName."'>{{data.features.".$this->featureInputName."}}";
    }
    private function createNumber()
    {
        return "<input type='number' name='".$this->featureInputName."' ng-model='\$parent.data.features.".$this->featureInputName."'>{{\$parent.data.features.".$this->featureInputName."}}";
    }
    private function createSelect()
    {
        return null;
    }
} 

