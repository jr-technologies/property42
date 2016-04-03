<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/1/2016
 * Time: 9:38 PM
 */

namespace App\DB\Providers\SQL;


use App\DB\FactoryProvider;
use App\DB\Interfaces\FactoryProviderInterface;
use App\DB\Providers\SQL\Factories\Factories\User\UserFactory as User;

class SQLFactoryProvider extends FactoryProvider implements FactoryProviderInterface{

    public function user()
    {
        return new User();
    }
} 