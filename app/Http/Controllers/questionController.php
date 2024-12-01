<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class questionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::paginate(1);
        return view('questions.show', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('questions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
           'question_text' => 'string|required|max:255',
           'answer'=>'string|required',
           'optionA'=>'string|required',
           'optionB'=>'string|required',
           'optionC'=>'string|required',
           'optionD'=>'string|required',
        ]);
        Question::create($validator);
        return redirect()->route('question.create')->with('success','question created successfully');
    }

    /**
     * Display the specified resource.
     */
    // public function show(String $id)
    // {
       
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $questions)
    {
        Question::all();
        return view('questions.update', compact('questions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $questions)
    {
        $request->validate([
            'question_text' => 'string|required|max:255',
            'answer'=>'string|required',
            'optionA'=>'string|required',
            'optionB'=>'string|required',
            'optionC'=>'string|required',
            'optionD'=>'string|required',
         ]);

         $questions = Question::findOrFail($questions->id);

         if(!$questions){
            return redirect()->route('question.edit')->with('error', 'Question not found');
         }

        $questions->question_text = $request->question_text;
        $questions->answer = $request->answer;
        $questions->optionA = $request->optionA;
        $questions->optionB = $request->optionB;
        $questions->optionC = $request->optionC;
        $questions->optionD = $request->optionD;
        
        $questions->save();
        return redirect()->route('question.index')->with('successupdate','question updated successfully');
    }

    public function delete(Question $questions)
    {
        Question::all();
        return view('questions.delete', compact('questions'));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $questions)
    {
       $questions = Question::findOrFail($questions->id);
       $questions->delete();
       return redirect()->route('question.index')->with('successdelete','question deleted successfully');
  
    }
}
