<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $guarded = ['id'];

    public function admin()
    {
        return $this->belongsTo('App\User', 'admin_id', 'id');
    }
}
