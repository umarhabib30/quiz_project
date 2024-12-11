<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $table = 'answers';
    protected $guarded = [];
    public function student(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function quiz(){
        return $this->belongsTo('App\Models\Quiz', 'quiz_id');
    }
    public function question(){
        return $this->belongsTo('App\Models\Question', 'question_id');
    }
}
