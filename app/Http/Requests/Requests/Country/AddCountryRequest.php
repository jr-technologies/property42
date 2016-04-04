<?php
/**
 * Created by PhpStorm.
 * User: Waqas
 * Date: 4/4/2016
 * Time: 2:33 PM
 */

namespace App\Http\Requests\Requests\Country;


use App\DB\Providers\SQL\Models\Country;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Transformers\Request\Country\AddCountriesTransformer;

class AddCountryRequest extends Request implements  RequestInterface
{
    public function __construct()
    {
        parent::__construct(new AddCountriesTransformer($this->getOriginalRequest()));
    }
    public function getCountryModel()
    {
        $country = new Country();
        $country->name = $this->get('country');
        return $country;
    }
    public function authorize(){}
    public function validate(){}
}