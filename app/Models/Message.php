<?php

namespace App\Models;


use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function scopeChekDoctor($query){

        return $query->where(['read2' => 0, 'sender_email' => Auth::guard('doctor')->user()->email]);

    }

    public function scopeChekAdmin($query){

        return $query->where(['read1' => 0, 'receiver_email' => Auth::guard('admin')->user()->email]);

    }

    public function scopeChekPatient($query){

        return $query->where(['read1' => 0, 'receiver_email' => Auth::guard('patient')->user()->email]);

    }
}
