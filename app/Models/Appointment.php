<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    //use Translatable;
    use HasFactory;
    //public $translatedAttributes = ['name'];
    public $fillable= ['name','email','phone','notes','doctor_id','section_id'];
}
