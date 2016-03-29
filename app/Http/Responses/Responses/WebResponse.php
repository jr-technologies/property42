<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 3/16/2016
 * Time: 1:46 PM
 */

namespace App\Http\Responses\Responses;

use App\Http\Responses\Interfaces\ResponseInterface;
use App\Http\Responses\Response as AppResponse;
class WebResponse extends AppResponse implements ResponseInterface
{
    private $view = 'defaultView';
    public function __construct(){}

    /**
     * @param $response
     * @param $headers
     * @return json
     * @description
     * following function accepts data from
     * controllers and return a pre-setted view.
     **/

    public function respond(array $response, array $headers = []){
        $http_status = $this->getHttpStatus();
        $response['status'] = ($http_status == 200)?1:0;
        $response['message'] = (isset($data['message']))?$data['message']:config('constants.SUCCESS_MESSAGE');
        return view($this->getView())->with('response',$response);
    }

    public function setView($viewName)
    {
        $this->view = $viewName;
        return $this;
    }
    public function getView()
    {
        return $this->view;
    }
}