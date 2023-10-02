<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class RayEmployee extends Authenticatable
{
    use HasFactory;
    protected $guarded=[];

    public function employee()
    {
        return $this->belongsTo(RayEmployee::class,'employee_id');
    }
}
