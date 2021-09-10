<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table='employee';
    protected $fillables=['firstname','lastname','company_id','employee_email','phone'];
    public function company(){
        return $this->hasOne('App\Models\Company');
    }
}
