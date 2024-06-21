<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'clockin_time',
        'clockout_time',
    ];

    protected $dates = [
        'clockin_time',
        'clockout_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function breaks()
    {
        return $this->hasMany(Breaks::class);
    }

    public function getProductiveHoursAttribute()
    {
        if ($this->clockin_time && $this->clockout_time) {
            $clockin = new Carbon($this->clockin_time);
            $clockout = new Carbon($this->clockout_time);
            return $clockout->diff($clockin)->format('%H:%I:%S');
        }
        return '00:00:00';
    }
   
}
