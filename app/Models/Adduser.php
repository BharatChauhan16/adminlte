<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adduser extends Model
{
    use HasFactory;

    protected $fillable = ['name','email','password','role'];


    protected static function boot()
    {
        parent::boot();

        // This will be triggered after the model is saved
        static::saved(function ($adduser) {
            // Save data to the users table
            User::create([
                'name' => $adduser->name,
                'email' => $adduser->email,
                'password' => $adduser->password,
            ]);
        });
    }
}
