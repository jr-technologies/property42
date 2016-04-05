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

class UpdateCountryRequest extends Request implements RequestInterface
{
    public function __construct()
    {

    }
    public function authorize()
    {}

    public function validate()
    {}
}