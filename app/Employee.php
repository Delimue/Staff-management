<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model {

    protected $fillable = ['firstName', 'lastName', 'userName', 'phone', 'email', 'title', 'salary'];

    public function teams(){
        
        return $this->hasMany(Team::class);
    }
}
