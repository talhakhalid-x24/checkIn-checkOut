<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOverTime extends Model
{
    use HasFactory;
    protected $table = 'user_over_times';
    protected $fillable = [
        'user_id',
        'total_hrs',
        'total_mints',
        'over_time'
    ];

    public function emp()
    {
        return $this->belongsTo('App\Models\UserDetail','user_id','id');
    }
}
