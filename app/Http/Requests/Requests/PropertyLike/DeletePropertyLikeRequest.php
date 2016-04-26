<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\PropertyLike;


use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\PropertyLikeValidators\DeletePropertyLikeValidator;
use App\Repositories\Repositories\Sql\PropertyLikeRepository;
use App\Transformers\Request\PropertyLike\DeletePropertyLikeTransformer;

class DeletePropertyLikeRequest extends Request implements RequestInterface{

    public $validator = null;
    private $PropertyLike = null;
    public function __construct(){
        parent::__construct(new DeletePropertyLikeTransformer($this->getOriginalRequest()));
        $this->validator = new DeletePropertyLikeValidator($this);
        $this->FeatureSection = new PropertyLikeRepository();
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

    public function getPropertyLikeModel()
    {
        return $this->PropertyLike->getById($this->get('id'));
    }

} 