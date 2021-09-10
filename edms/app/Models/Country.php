<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $table ="country";
    protected $fillable=[
        'country_name'
    ];
    public function employees(){
        return $this->belongsTo('App\Models\Employees');
    }
}
