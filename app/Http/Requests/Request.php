<?php

namespace App\Http\Requests;

use App\Traits\RequestHelper;
use App\Transformers\Transformer;

abstract class Request
{
    use RequestHelper;

    private $transformedValues = [];
    private $transformer = null;
    public $authenticator = null;
    public function __construct(Transformer $transformer){
        $this->transformer = $transformer;
        $this->transformedValues = $this->transformer->transform();
        $this->authenticator = $this->getRequestAuthenticator();
    }

    public function get($key){
        return (isset($this->transformedValues[$key]))?$this->transformedValues[$key]:null;
    }

    public function getOriginal($key){
        return request()->get($key);
    }

    public function all(){
        return $this->transformedValues;
    }

    public function allOriginal(){
        return request()->all();
    }

    public function getOriginalRequest()
    {
        return request();
    }

    /*
     * tells weather the request is authentic.
     */
    public function authentic(){
        return $this->authenticator->authenticate();
    }

    /*
     * tells weather the request is not authentic.
     */
    public function isNotAuthentic(){
        return (!$this->authentic())?true: false;
    }
}
