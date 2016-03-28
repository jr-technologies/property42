<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 3/16/2016
 * Time: 1:46 PM
 */

namespace App\Http\Responses;


abstract class Response
{
    public $CUSTOM_STATUS = 0;
    public $HTTP_STATUS = 200;

    public function setHttpStatus($status){
        $this->HTTP_STATUS = $status;
        return $this;
    }
    public function getHttpStatus(){
        return $this->HTTP_STATUS;
    }
    public function setCustomStatus($status){
        $this->CUSTOM_STATUS = $status;
        return $this;
    }
    public function getCustomStatus(){
        return $this->CUSTOM_STATUS;
    }

    public function respondWithErrors(array $messages=[]){
        return $this->respond([
            'status' => 0,
            'error' => [
                'messages'=>$messages,
                'code' => $this->getCustomStatus()
            ],
            'data' => null
        ]);
    }

    public function respondNotFound($messages=["record not found"])
    {
        return $this->setHttpStatus(404)->setCustomStatus(404)->respondWithErrors($messages);
    }
    public function respondInternalServerError($messages=["Something went wrong with the server!"])
    {
        return $this->setHttpStatus(500)->setCustomStatus(505)->respondWithErrors($messages);
    }
    public function respondValidationFails($messages=["Your request did not passed our server requirements!"])
    {
        return $this->setHttpStatus(403)->setCustomStatus(403)->respondWithErrors($messages);
    }
    public function respondAuthenticationFailed($messages=["Dear user you are not logged in."])
    {
        return $this->setHttpStatus(403)->setCustomStatus(403)->respondWithErrors($messages);
    }
    public function respondInvalidCredentials($messages=["Invalid username or password"])
    {
        return $this->setHttpStatus(403)->setCustomStatus(403)->respondWithErrors($messages);
    }
    public function respondAccessTokenNotProvided($messages=["Session expired, please login again."])
    {
        return $this->setHttpStatus(403)->setCustomStatus(403)->respondWithErrors($messages);
    }
    public function respondInvalidAccessToken($messages=["Session expired, please login again."])
    {
        return $this->setHttpStatus(403)->setCustomStatus(403)->respondWithErrors($messages);
    }
    public function respondOwnershipConstraintViolation($messages=["Ownership Constraint Violation."])
    {
        return $this->setHttpStatus(403)->setCustomStatus(403)->respondWithErrors($messages);
    }
}