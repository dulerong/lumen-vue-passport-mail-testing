<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    protected $fillable = [ 'location', 'age', 'birthorder', 'gender', 'count', 'male', 'female', 'comment'];

    public function user(){
        return $this->belongsTo('App\User');
    }

}
