<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Run extends Model
{
    //

    protected $fillable = [
        'id', 'user_id', 'distance', 'seconds', 'notes', 'date', 'year', 'month', 'weekofyear'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
