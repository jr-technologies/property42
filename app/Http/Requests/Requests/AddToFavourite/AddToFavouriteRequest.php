<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\AddToFavourite;

use App\DB\Providers\SQL\Models\FavouriteProperty;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\AddToFavouriteValidators\AddToFavouriteValidator;
use App\Transformers\Request\AddToFavourite\AddToFavouriteTransformer;
use Illuminate\Support\Facades\Session;

class AddToFavouriteRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new AddToFavouriteTransformer($this->getOriginalRequest()));
        $this->validator = new AddToFavouriteValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }
    public function favouriteProperty()
    {
        $addToFavourite = new FavouriteProperty();
        $user = session()->get('authUser');
        $addToFavourite->userId =$user->id;
        $addToFavourite->propertyId = $this->get('propertyId');
        return $addToFavourite;
    }
} 