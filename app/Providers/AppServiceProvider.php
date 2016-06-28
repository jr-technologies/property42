<?php

namespace App\Providers;

use App\Repositories\Repositories\Sql\PropertyTypeRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $propertyTypes;
    public function __construct()
    {
        $this->propertyTypes = new PropertyTypeRepository();
    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $data = [
            'propertyTypes' =>$this->propertyTypes->all(),
        ];
        view()->share('globals', $data);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
