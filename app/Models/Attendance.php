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
        'productive_hours',
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
}
