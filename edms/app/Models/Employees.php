<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;
    protected $fillable = [
        'salutation',
        'firstname',
        'lastname',
        'email',
        'address',
        'gender',
        'dateofjoining',
        'country_id',
        'state_id',
        'city',
        'pincode',
        'created_by',
        'updated_by',
    ];
    public function employee(){
        return $this->hasOne('App\Models\Country');
        return $this->hasOne('App\Models\State');
    }
}
