<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $table='company';
    protected $fillables=['name','email','website','image','is_deleted'];
    public function employee(){
        return $this->belongsTo('App\Models\Employee');
    }
}
