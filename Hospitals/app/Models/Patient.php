<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Patient extends Authenticatable
{
    use Translatable;
    use HasFactory;
    public $translatedAttributes = ['name','Address'];
    public $fillable= ['email','Password','Date_Birth','Phone','Gender','Blood_Group'];

    public function employee()
    {
        return $this->belongsTo(RayEmployee::class,'employee_id');
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class,'doctor_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class,'Service_id');
    }
}