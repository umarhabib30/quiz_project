<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;
    protected $table = 'classes';
    protected $guarded = [];
    public function creator(){
        return $this->belongsTo('App\Models\User', 'created_by');
    }
}
