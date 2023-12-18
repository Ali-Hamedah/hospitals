<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RayEmployee extends Authenticatable
{
    use HasFactory;

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
