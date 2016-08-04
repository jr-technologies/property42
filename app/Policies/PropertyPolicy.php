<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 3/22/2016
 * Time: 12:39 PM
 */

namespace App\Policies;

use App\DB\Providers\SQL\Models\Property;
use App\DB\Providers\SQL\Models\User;

class PropertyPolicy extends Policy
{
    public function update(User $object ,Property $property=null)
    {
        return true;
    }
}