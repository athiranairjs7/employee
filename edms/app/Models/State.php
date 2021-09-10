<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    protected $table ="state";
    protected $fillable=[
        'state_name','country_id'
    ];
    public function employees(){
        return $this->belongsTo('App\Models\Employees');
    }
}
