@extends('layouts.teacher')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-semibold mb-4">Create New Quiz</h2>

    <form action="{{ route('teacher.quizzes.store') }}" method="POST">
        @csrf
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium mb-1">Quiz Title</label>
                <input type="text" name="title" required class="w-full p-2 border rounded">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Quiz Type</label>
                <select name="type" class="w-full p-2 border rounded">
                    <option value="mcq">Multiple Choice</option>
                    <option value="tf">True/False</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Description</label>
                <textarea name="description" class="w-full p-2 border rounded" rows="3"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Expiration Date</label>
                <input type="datetime-local" name="expires_at" class="w-full p-2 border rounded">
                <p class="text-xs text-gray-500 mt-1">Leave empty for no expiration</p>
            </div>

            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                Create Quiz
            </button>
        </div>
    </form>
</div>
@endsection
