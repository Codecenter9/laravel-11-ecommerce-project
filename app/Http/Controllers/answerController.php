<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class answerController extends Controller
{
   public function index(){

      $answers = Answer::all();
      $questions = Question::all();
      $score=0;
      foreach($answers as $answer)
   {   
    $question = $questions->find($answer->questions_id);
    if($question && $answer->chosenanswer == $question->answer){
$score++;
      }
      }

      $totalquestions = $questions->count();
$persentagescore = ($totalquestions > 0) ? ($score/$totalquestions)*100 : 0;
$message = ($persentagescore >= 50) ? 'congratulation! you passed the exam.' : 'sorry! you faild the exam.';

      return view('main.result', compact('answers','questions','score','message','totalquestions'));
  }

   public function store(Request $request){
     $request->validate([
     'questions_id'=>'integer|required',
     'answer'=>'string|required',
    ]);
    Answer::create([
      'questions_id'=>$request->questions_id,
      'chosenanswer'=>$request->answer, 
    ]);
    return redirect()->route('question.index')->with('success','answer submitted successfully');
   }
   

}


