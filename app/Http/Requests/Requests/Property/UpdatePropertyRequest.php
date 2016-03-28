<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 3/17/2016
 * Time: 2:36 PM
 */

namespace App\Http\Requests\Requests\Property;


use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Transformers\Request\UpdatePropertyTransformer;

class UpdatePropertyRequest extends Request implements RequestInterface
{
    public function __construct()
    {
        parent::__construct(new UpdatePropertyTransformer());
    }
    public function authorize()
    {

        return true;
    }

    public function validate()
    {
        return true;
    }
}