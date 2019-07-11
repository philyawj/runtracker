<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    //

    protected $fillable = [
        'id', 'user_id', 'miles', 'year', 'weekofyear'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

}
