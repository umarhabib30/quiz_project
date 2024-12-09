<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
   protected $table = 'questions';
    protected $guarded = [];
    public function quiz(){
        return $this->belongsTo('App\Models\Quiz', 'quiz_id');
    }
}
