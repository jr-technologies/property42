<?php
/**
 * Created by WAQAS.
 * User: JR Tech
 * Date: 4/7/2016
 * Time: 11:10 AM
 */
namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Requests\Society\AddSocietyRequest;
use App\Http\Requests\Requests\Society\DeleteSocietyRequest;
use App\Http\Requests\Requests\Society\GetAllSocietiesRequest;
use App\Http\Requests\Requests\Society\UpdateSocietyRequest;
use App\Http\Responses\Responses\ApiResponse;
use App\Repositories\Repositories\Sql\SocietiesRepository;

class SocietiesController extends ApiController
{
    private $society ;
    public $response;
    public function __construct
    (
        SocietiesRepository $societiesRepository,
        ApiResponse $response
    )
    {
        $this->society  = $societiesRepository;
        $this->response = $response;
    }
    public function store(AddSocietyRequest $request)
    {
        return $this->response->respond(['data'=>['society'=>
            $this->society->store($request->getSocietyModel())]]);
    }
    public function all(GetAllSocietiesRequest $request)
    {
        return $this->response->respond(['data'=>[
            'country'=>$this->society->all()
        ]]);
    }
    public function delete(DeleteSocietyRequest $request)
    {
        return $this->response->respond(['data'=>[
            'country'=>$this->society->delete($request->getSocietyModel())
        ]]);
    }
    public function update(UpdateSocietyRequest $request)
    {
        return $this->response->respond(['data'=>[
            'country'=>$this->society->update($request->getSocietyModel())
        ]]);
    }
}