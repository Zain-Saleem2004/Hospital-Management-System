<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use App\Models\Models\SectionTranslation;

class Section extends Model implements TranslatableContract
{
    use HasFactory;
    protected $fillable=['name','description'];
    use Translatable; // To add translation methods
    // To define which attributes needs to be translated
    public $translatedAttributes = ['name','description'];


    public function doctors(){
        return $this->hasMany(Doctor::class);
    }

    
}
