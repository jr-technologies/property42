<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Requests\Agency\AddAgencyRequest;
use App\Http\Requests\Requests\Agency\UpdateAgencyRequest;
use App\Http\Responses\Responses\ApiResponse;
use App\Repositories\Repositories\Sql\AgenciesRepository;
use Illuminate\Support\Facades\File;

class AgencyController extends ApiController
{
    private $agency = null;
    public $response = null;
    public function __construct
    (
        ApiResponse $response,
        AgenciesRepository $agenciesRepository
    )
    {
        $this->agency =  $agenciesRepository;
        $this->response = $response;
    }
    public function store(AddAgencyRequest $request)
    {
        $agency = $request->getAgencyModel();
        $agency->id = $this->agency->storeAgency($agency);
        return $this->response->respond(['data' => [
            'Agency' => $agency
        ]]);
    }
    public function update(UpdateAgencyRequest $request)
    {
        $agency =$request->getAgencyModel();
        $this->agency->updateAgency($agency);
        return $this->response->respond(['data' => [
            'Agency' => $agency
        ]]);
    }
    public function delete(UpdateAgencyRequest $request)
    {
        $this->agency->deleteAgency($request->getAgencyModel());
        File::delete(storage_path('app/'.$request->getAgencyModel()->logo));
        return $this->response->respond(['data'=>[],'message'=>'deleted successfully']);
    }
}
