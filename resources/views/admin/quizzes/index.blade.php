@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-6">Quiz Management</h1>

    <div class="bg-white rounded shadow overflow-hidden">
        @foreach($quizzes as $quiz)
        <div class="p-4 border-b flex justify-between items-center">
            <div>
                <h3 class="font-medium">{{ $quiz->title }}</h3>
                <p class="text-gray-600">By {{ $quiz->author->name }} in {{ $quiz->classroom->name }}</p>
            </div>
            <form method="POST" action="{{ route('admin.quizzes.delete', $quiz) }}">
                @csrf @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">Delete</button>
            </form>
        </div>
        @endforeach
    </div>
    <div class="mt-4">
        {{ $quizzes->links() }}
    </div>
</div>
@endsection
