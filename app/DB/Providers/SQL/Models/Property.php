<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 10:17 AM
 **/

namespace App\DB\Providers\SQL\Models;

class Property {

    public $id = 0;
    public $purposeId;
    public $ownerId;
    public $subTypeId;
    public $blockId;
    public $title;
    public $description;
    public $price;
    public $landUnitId;
    public $landArea;
    public $statusId;
    public $isFeatured;
    public $isHot;
    public $totalViews;
    public $ratings;
    public $totalLikes;
    /* contact info */
    public $contactPerson;
    public $phone;
    public $mobile;
    public $fax;
    public $email;

    public $createdBy;
    public $createdAt = '0000-00-00 00:00:00';
    public $updatedAt = '0000-00-00 00:00:00';

    public function __construct()
    {
        $this->createdAt = date('Y-m-d h:i:s');
        $this->updatedAt = $this->createdAt;
    }

} 

