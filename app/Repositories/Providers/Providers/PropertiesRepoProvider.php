<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 4/28/2016
 * Time: 11:30 AM
 */

namespace App\Providers\Repositories\Providers\Providers;


use App\Providers\Repositories\Providers\RepositoryProvider;
use App\Providers\Repositories\Providers\RepositoryProviderInterface;
use App\Repositories\Repositories\Sql\PropertiesRepository;

class PropertiesRepoProvider extends RepositoryProvider implements RepositoryProviderInterface
{

    /**
     * @return PropertiesRepository
     */
    public function repo()
    {
        return new PropertiesRepository();
    }
}