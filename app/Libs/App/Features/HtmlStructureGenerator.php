<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 5/5/2016
 * Time: 2:44 PM
 */

namespace App\Libs\App\Features;


use App\DB\Providers\SQL\Models\Features\Feature;

class HtmlStructureGenerator
{
    /* @var $feature Feature*/
    private $feature = null;
    public function __construct(Feature $feature)
    {
        $this->feature = $feature;
    }

    public function generate()
    {
        $feature = $this->feature;
    }
}