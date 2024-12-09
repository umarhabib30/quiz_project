<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $table = 'quizzes';
    protected $guarded = [];
    public function class(){
        return $this->belongsTo('App\Models\classes', 'class_id');
    }
}
