<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 4/5/2016
 * Time: 10:25 AM
 */

namespace App\Http\Requests\Requests\Country;


use App\DB\Providers\SQL\Models\Country;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Repositories\Repositories\Sql\CountriesRepository;
use App\Transformers\Request\Country\DeleteCountryTransformer;

class DeleteCountryRequest extends Request implements RequestInterface
{
    private $countries = null;
    public function __construct()
    {
        parent::__construct(new DeleteCountryTransformer($this->getOriginalRequest()));
        $this->countries = new CountriesRepository();
    }
    public function getCountryModel()
    {
        $country = $this->countries->getById($this->get('id'));
        return $country;
    }
    public function authorize(){}

    public function validate(){}
}