<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Questions') }}
        </h2>
    </x-slot>

    <div class="container py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div id="timer">Time Left: <span id="timer-sec">15</span> seconds</div>
                    <button id="start">Start</button>

                    @if (session('success'))
                        <div class="alert alert-success">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif
                    @if (session('successupdate'))
                        <div class="alert alert-success">
                            <p>{{ session('successupdate') }}</p>
                        </div>
                    @endif
                    @if (session('successdelete'))
                        <div class="alert alert-danger">
                            <p>{{ session('successdelete') }}</p>
                        </div>
                    @endif
                    @if (Auth::check() && Auth::user()->is_admin)
                        <a href="{{ route('question.create') }}" class="btn btn-primary m-2">Create Questions</a>
                    @endif

                    @if ($questions->isempty())
                        <p>hmmm. questions not available.</p><br>
                    @else
                        <form action="{{ route('result.store') }}" method="post" id="inputform">
                            @csrf

                            @foreach ($questions as $question)
                                <p>{{ $question->id }}. {{ $question->question_text }}
                                    @if (Auth::check() && Auth::user()->is_admin)
                                        <a href="{{ route('question.edit', $question->id) }}"
                                            class="btn btn-outline-primary m-3">EDIT</a>
                                        <a href="{{ route('question.delete', $question->id) }}"
                                            class="btn btn-outline-danger m-3">DELETE</a>
                                    @endif
                                </p>
                                <div class="1">
                                    <input type="hidden" name="questions_id" value="{{ $question->id }}">
                                </div>
                                <div class="p-2 m-2">
                                    <label for=""><input type="radio" name="answer" value="A"
                                            id="" class="m-2"> (A). {{ $question->optionA }} </label>
                                    <label for=""><input type="radio" name="answer" value="B"
                                            id="" class="m-2"> (B). {{ $question->optionB }} </label>
                                </div>
                                <div class="p-2">
                                    <label for=""><input type="radio" name="answer" value="C"
                                            id="" class="m-2"> (C). {{ $question->optionC }} </label>
                                    <label for=""><input type="radio" name="answer" value="D"
                                            id="" class="m-2"> (D). {{ $question->optionD }} </label>
                                </div>

                                <button type="submit" class="btn btn-success m-3">Submit</button>
                            @endforeach

                        </form>
                    @endif
                    {{ $questions->links() }}
                </div>
            </div>
        </div>
    </div>


</x-app-layout>

<script>
    let submittedQuestions = new Set();
    document.getElementById('inputform').onsubmit = function(event) {
        const radios = document.querySelectorAll('input[type="radio"]');
        const questionId = event.target.elements['questions_id'].value;
        if (submittedQuestions.has(questionId)) {
            alert('You have already submitted an answer for this question.');
            event.preventDefault();
            return;
        }
        submittedQuestions.add(questionId);
        radios.forEach(radio => {
            radio.disabled = true;
        });

    };

    let currentQuestionIndex = {{ $questions->min('id') }};
    let time = 15;
    let timerId;

    function startQuiz() {
        timerId = setInterval(clockTick, 1000);
        loadQuestion();
    }

    function clockTick() {
        time--;
        document.getElementById("timer-sec").textContent = time;

        if (time <= 0) {
            clearInterval(timerId);
            alert("Time's up! Moving to the next question.");
            nextQuestion();
        }
    }

    function loadQuestion() {

        time = 15;
        document.getElementById("timer-sec").textContent = time;
        startTimer();
    }

    function nextQuestion() {
        currentQuestionIndex++;
        if (currentQuestionIndex < questions.length) {
            loadQuestion();
        } else {
            endQuiz();
        }
    }

    function endQuiz() {
        clearInterval(timerId);
        alert("Quiz finished!");

    }

    function startTimer() {
        timerId = setInterval(clockTick, 1000);
    }

    document.getElementById("start").addEventListener("click", startQuiz);
</script>
