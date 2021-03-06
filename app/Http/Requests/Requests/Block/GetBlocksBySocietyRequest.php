<?php
/**
 * Created by WAQAS
 * User: waqas
 * Date: 4/8/2016
 * Time: 11:26 AM
 */

namespace App\Http\Requests\Requests\Block;

use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\BlockValidators\GetBlocksBySocietyValidator;
use App\Transformers\Request\Block\GetBlocksBySocietyTransformer;

class GetBlocksBySocietyRequest extends Request implements RequestInterface
{
    public $validator = null;
    public function __construct()
    {
        parent::__construct(new GetBlocksBySocietyTransformer($this->getOriginalRequest()));
        $this->validator = new GetBlocksBySocietyValidator($this);
    }
    public function authorize()
    {

    }
    public function validate()
    {
        return $this->validator->validate();
    }

}