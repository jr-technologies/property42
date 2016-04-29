<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\UserRole;


use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\LandUnitValidators\DeleteLandUnitValidator;
use App\Repositories\Repositories\Sql\LandUnitsRepository;
use App\Transformers\Request\LandUnit\DeleteLandUnitTransformer;

class DeleteUserRoleRequest extends Request implements RequestInterface{

    public $validator = null;
    private $landUnit = null;
    public function __construct(){
        parent::__construct(new DeleteUserRoleTransformer($this->getOriginalRequest()));
        $this->validator = new DeleteUserRoleValidator($this);
        $this->landUnit = new UserRoleRepository();
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

    public function getLandUnitModel()
    {
        return $this->landUnit->getById($this->get('id'));
    }

} 