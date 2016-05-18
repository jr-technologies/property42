<?php
/**
 * Created by PhpStorm.
 * User: WAQAS
 * Date: 5/17/2016
 * Time: 11:45 AM
 */

namespace App\Events\Events\Feature;

use App\Events\Events\Event;
use Illuminate\Queue\SerializesModels;

class FeatureJsonCreated extends Event
{

    use SerializesModels;


    public $feature = [];

    public function __construct(array $feature)
    {
        $this->feature = $feature;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}