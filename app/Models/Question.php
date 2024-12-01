<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['question_text','optionA','optionB','optionC','optionD','answer'];

    public function answer(){
        $this->hasMany(Answer::class);
    }
}
