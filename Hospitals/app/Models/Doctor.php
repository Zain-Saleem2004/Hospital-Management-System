<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Authenticatable
{
    use Translatable;
    use HasFactory;

    // To define which attributes needs to be translated
    public $translatedAttributes = ['name','appointments'];
    public $fillable = ['name','doctor_id','email','email_verified_at','password','phone','section_id','Status'];

    //Get the doctors's image.
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function section() {
        return $this->belongsTo(Section::class);
        
    }

    public function doctorappointments() {
        return $this->belongsToMany(Appointment::class,'appointment_doctor');
        
    }

}
