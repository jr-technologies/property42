<?php

namespace App\Models\Sql;

use Illuminate\Database\Eloquent\Model;

class UserDocument extends Model
{
    protected $table = "user_json";
    public function decode()
    {
        return json_decode($this->json);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\Sql\User');
    }
}
