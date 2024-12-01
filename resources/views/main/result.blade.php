<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Your Result - {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="container py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="alert alert-success">{{ $message }}</div>
                    @if ($answers->isempty())
                        <p>answers not available.</p>
                    @else
                        <p>your answers.</p>

                        @foreach ($answers as $answer)
                            @php
                                $question = $questions->find($answer->questions_id);
                            @endphp

                            @if ($question && $answer->chosenanswer == $question->answer)
                                <p>{{ $answer->questions_id }}. {{ $answer->chosenanswer }}. <span
                                        class="text-success">Correct</span>
                                </p>
                            @else
                                <p>{{ $answer->questions_id }}. {{ $answer->chosenanswer }}. <span
                                        class="text-danger">Incorrect</span>
                                </p>
                            @endif
                        @endforeach
                        <p>Your exam result: {{ $score }} / {{ $totalquestions }} or
                            {{ ($score / $totalquestions) * 100 }}%</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
