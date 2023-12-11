<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use Translatable;
    use HasFactory;
    public $translatedAttributes = ['name', 'locale'];
    public $fillable= ['price','description','status'];


}
