<?php
/**
 * Created by WAQAS.
 * User: JR Tech
 * Date: 4/7/2016
 * Time: 11:10 AM
 */
namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Requests\Block\AddBlockRequest;
use App\Http\Requests\Requests\Block\DeleteBlockRequest;
use App\Http\Requests\Requests\Block\GetAllBlocksRequest;
use App\Http\Requests\Requests\Block\UpdateBlockRequest;
use App\Http\Responses\Responses\ApiResponse;
use App\Repositories\Repositories\Sql\BlocksRepository;

class BlocksController extends ApiController
{
    private $block = null;
    public $response = null;
    public function __construct
    (
        BlocksRepository $blocksRepository,
        ApiResponse $response
    )
    {
        $this->block  = $blocksRepository;
        $this->response = $response;
    }
    public function store(AddBlockRequest $request)
    {

        return $this->response->respond(['data'=>['block'=>
                $this->block->store($request->getBlockModel())]]);
    }
    public function all(GetAllBlocksRequest $request)
    {
        return $this->response->respond(['data'=>[
            'block'=>$this->block->all()
        ]]);
    }
    public function delete(DeleteBlockRequest $request)
    {
        return $this->response->respond(['data'=>[
            'block'=>$this->block->delete($request->getBlockModel())
        ]]);
    }
    public function update(UpdateBlockRequest $request)
    {
        return $this->response->respond(['data'=>[
            'block'=>$this->block->update($request->getBlockModel())
        ]]);
    }
}