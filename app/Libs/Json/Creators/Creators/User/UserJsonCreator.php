<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 3/25/2016
 * Time: 11:39 AM
 */

namespace App\Libs\Json\Creators\Creators\User;

use App\Libs\Json\Creators\Creators\JsonCreator;
use App\Libs\Json\Creators\Interfaces\JsonCreatorInterface;
use App\Libs\Json\Prototypes\Prototypes\User\UserJsonPrototype;
use App\DB\Providers\SQL\Models\User;
use App\Repositories\Repositories\Sql\CountriesRepository;
use App\Repositories\Repositories\Sql\MembershipPlansRepository;

class UserJsonCreator extends JsonCreator implements JsonCreatorInterface
{
    private $membershipPlanJsonCreator = null;
    private $agencyJsonCreator = null;

    private $countries = null;
    private $membershipPlans = null;
    public function __construct(User $user = null)
    {
        $this->model = $user;
        $this->prototype = new UserJsonPrototype();

        $this->membershipPlanJsonCreator = new MembershipPlanJsonCreator();
        $this->agencyJsonCreator = new AgencyJsonCreator();

        $this->countries = new CountriesRepository();
        $this->membershipPlans = new MembershipPlansRepository();
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
        return [];
        $agencies = [];
        $userAgencies = $this->model->agencies;
        foreach($userAgencies as $agency)
        {
            $agencies[] = $this->agencyJsonCreator->setModel($agency)->create();
        }
        return $agencies;
    }
}