<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 3/25/2016
 * Time: 11:39 AM
 */

namespace App\Libs\Json\Creators\Creators\User;

use App\DB\Providers\SQL\Models\Agency;
use App\Libs\Json\Creators\Creators\JsonCreator;
use App\Libs\Json\Creators\Interfaces\JsonCreatorInterface;
use App\Libs\Json\Prototypes\Prototypes\User\UserJsonPrototype;
use App\DB\Providers\SQL\Models\User;
use App\Repositories\Repositories\Sql\AgenciesRepository;
use App\Repositories\Repositories\Sql\CountriesRepository;
use App\Repositories\Repositories\Sql\MembershipPlansRepository;

class UserJsonCreator extends JsonCreator implements JsonCreatorInterface
{
    private $membershipPlanJsonCreator = null;
    private $agencyJsonCreator = null;

    private $countries = null;
    private $membershipPlans = null;
    private $agencies = null;
    public function __construct(User $user = null)
    {
        $this->model = $user;
        $this->prototype = new UserJsonPrototype();

        $this->membershipPlanJsonCreator = new MembershipPlanJsonCreator();
        $this->agencyJsonCreator = new AgencyJsonCreator();

        $this->countries = new CountriesRepository();
        $this->membershipPlans = new MembershipPlansRepository();
        $this->agencies = new AgenciesRepository();
    }

    public function create()
    {
        $this->prototype->id = $this->model->id;
        $this->prototype->email = $this->model->email;
        $this->prototype->fName = $this->model->fName;
        $this->prototype->lName = $this->model->lName;
        $this->prototype->phone = $this->model->phone;
        $this->prototype->mobile = $this->model->mobile;
        $this->prototype->fax = $this->model->fax;
        $this->prototype->address = $this->model->address;
        $this->prototype->zipCode = $this->model->zipCode;
        $this->prototype->country = $this->country();
        $this->prototype->membershipPlan = $this->membershipPlan();
        $this->prototype->agencies = $this->agencies();
        $this->prototype->createdAt = $this->model->createdAt;
        $this->prototype->updatedAt = $this->model->updatedAt;
        return $this->prototype;
    }

    public function country()
    {
        return $this->countries->getById($this->model->countryId)->name;
    }

    public function membershipPlan()
    {
        $plan = $this->membershipPlans->getById($this->model->membershipPlanId);
        return $this->membershipPlanJsonCreator->setModel($plan)->create();
    }

    public function agencies()
    {
        $agencies = $this->agencies->getByUser($this->model->id);
        $agenciesJson = [];
        foreach($agencies as $agency) /* @var $agency Agency::class */
        {
            $agenciesJson[] = $this->agencyJsonCreator->setModel($agency)->create();
        }
        return $agenciesJson;
    }
}