<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use HasFactory;
    protected $table = 'students';
    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'role',
        'class_id',
        'image'

    ];
     protected $hidden = [
        'password',
        'remember_token',
    ];
    public function class(){
        return $this->belongsTo('App\Models\classes', 'class_id');
    }
}
