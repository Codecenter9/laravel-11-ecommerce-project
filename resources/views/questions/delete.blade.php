<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center">
                    <p>Notice! you are going to delete question {{ $questions->id }}</p><br>
 <form action="{{ route('question.destroy',$questions->id) }}" method="post">       
    @csrf
    @method('delete')
    <input type="hidden" name="" value="{{ $questions->id }}">
    <button type="submit" value="Yes" class="btn btn-danger m-3">Yes! Proceed</button>
    <a href="{{ route('question.index') }}" class="btn btn-primary m-3">Back</a>
</form>
</div>
</div>
</div>
</div>
</x-app-layout>