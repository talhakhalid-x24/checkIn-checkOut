<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLeave extends Model
{
    use HasFactory;
    protected $table = 'user_leaves';
    protected $fillable = [
        'user_id',
        'join_date',
        'allow',
        'not_allow',
        'valid_for_year',
        'total_leaves'
    ];
    public function emp()
    {
        return $this->belongsTo('App\Models\UserDetail','user_id','id');
    }
}
