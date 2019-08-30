<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Run extends Model
{
    //

    protected $fillable = [
        'id', 'user_id', 'miles', 'seconds', 'notes', 'date', 'year', 'month', 'week_of_year', 'pace'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
