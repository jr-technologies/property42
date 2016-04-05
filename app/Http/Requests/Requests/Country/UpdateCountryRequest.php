<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 4/5/2016
 * Time: 9:15 AM
 */

namespace App\Http\Requests\Requests\Country;


use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;

use App\Transformers\Request\Country\UpdateCountryTransformer;
use App\DB\Providers\SQL\Models\Country;
class UpdateCountryRequest extends Request implements RequestInterface
{
    public function __construct()
    {
        parent::__construct(new UpdateCountryTransformer($this->getOriginalRequest()));
    }
    public function authorize()
    {}

    public function validate()
    {}
    public function getCountryModel()
    {
        $country = new Country();
        $country->id   = $this->get('id');
        $country->name = $this->get('country');
        return $country;
    }
}