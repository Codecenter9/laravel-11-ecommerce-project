<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
   protected $fillable = ['questions_id','chosenanswer'];
}
