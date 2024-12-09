<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function student(){
        return $this->belongsTo('App\Models\User', 'student_id');
    }
    public function class(){
        return $this->belongsTo('App\Models\Classes', 'class_id');
    }
}
