<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adduser extends Model
{
    use HasFactory;

    protected $fillable = ['name','email','password','role'];


    public function userProfile()
    {
        return $this->hasOne(UserProfile::class);
    }
}
