<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="container py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('error'))
                    <div class="alert alert-success">
                        <p>{{ session('error') }}</p>
                    </div>
                    @endif
<form action="{{ route('question.update', $questions->id)}}" method="post">

    @csrf
    @method('patch')
    <label for="inputquestion">#Question</label>
          <input type="text" class="form-control form-control-lg" name="question_text" id="inputquestion" value=" {{ $questions->question_text }} ">
<div class="p-3">
   <div class="p-2">
    <label for="inputA">(A): </label>
    <input type="text" class="" name="optionA" value=" {{ $questions->optionA }} ">
    <label for="inputB">(B): </label>
    <input type="text" class="" name="optionB" value=" {{ $questions->optionB }}"> 
   </div>
   <div class="p-2">
    <label for="inputC">(C): </label>
    <input type="text" class="" name="optionC" value=" {{ $questions->optionC }}"> 
    <label for="inputD">(D): </label>
    <input type="text" class="" name="optionD" value=" {{ $questions->optionD }}">
   </div>

</div>
<select name="answer" id="">
    <option value="A">A</option>
    <option value="B">B</option>
    <option value="C">C</option>
    <option value="D">D</option>
</select>
<button type="submit" class="btn btn-primary">Update question</button>

 </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>