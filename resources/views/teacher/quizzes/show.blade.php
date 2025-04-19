@extends('layouts.teacher')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-semibold">{{ $quiz->title }}</h2>
            <p class="text-gray-600">{{ $quiz->description }}</p>
            <p class="text-sm text-gray-500 mt-1">
                Type: {{ $quiz->type === 'mcq' ? 'Multiple Choice' : 'True/False' }} |
                Questions: {{ $quiz->questions->count() }}
            </p>
        </div>
        <div>
            <a href="{{ route('teacher.quizzes') }}" class="text-indigo-600 hover:underline">Back to Quizzes</a>
        </div>
    </div>

    <!-- Questions Section -->
    <div class="mt-8">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold">Questions</h3>
            <button @click="showQuestionForm = !showQuestionForm"
                    class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                Add Question
            </button>
        </div>

        <!-- Add Question Form -->
        <div x-show="showQuestionForm" x-transition class="mb-8 p-4 border rounded-lg bg-gray-50">
            <form action="{{ route('teacher.quizzes.questions.store', $quiz) }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Question Text *</label>
                        <textarea name="content" rows="3" required
                                  class="w-full p-2 border rounded focus:ring-2 focus:ring-indigo-500"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Points *</label>
                        <input type="number" name="points" min="1" value="1" required
                               class="w-full p-2 border rounded focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <!-- Answers Section -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium mb-1">Correct Answer *</label>

                        @if($quiz->type === 'mcq')
                            <!-- Multiple Choice Answers -->
                            @for($i = 0; $i < 4; $i++)
                                <div class="flex items-center space-x-2">
                                    <input type="radio" name="correct_answer" value="{{ $i }}"
                                           {{ $i === 0 ? 'checked' : '' }}
                                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500">
                                    <input type="text" name="answers[]" required
                                           placeholder="Option {{ $i+1 }}"
                                           class="flex-1 p-2 border rounded focus:ring-2 focus:ring-indigo-500">
                                </div>
                            @endfor
                        @else
                            <!-- True/False Answers -->
                            <div class="space-y-2">
                                <div class="flex items-center space-x-2">
                                    <input type="radio" name="correct_answer" value="0" checked
                                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500">
                                    <span>True</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <input type="radio" name="correct_answer" value="1"
                                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500">
                                    <span>False</span>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                                class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Save Question
                        </button>
                        <button type="button" @click="showQuestionForm = false"
                                class="ml-2 bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300">
                            Cancel
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Questions List -->
        @if($quiz->questions->isEmpty())
            <div class="bg-gray-50 p-4 rounded-lg text-center">
                <p class="text-gray-500">No questions added yet.</p>
                <button @click="showQuestionForm = true"
                        class="mt-2 bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                    Add Your First Question
                </button>
            </div>
        @else
            <div class="space-y-4">
                @foreach($quiz->questions as $question)
                    <div class="border rounded-lg p-4 hover:shadow-md transition-shadow">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <div class="flex items-start space-x-2">
                                    <span class="text-gray-500">{{ $loop->iteration }}.</span>
                                    <div>
                                        <h4 class="font-medium">{{ $question->content }}</h4>
                                        <p class="text-sm text-gray-500">{{ $question->points }} point(s)</p>

                                        <div class="mt-2 space-y-1">
                                            @foreach($question->answers as $answer)
                                                <div class="flex items-center">
                                                    <span class="mr-2 {{ $answer->is_correct ? 'text-green-500 font-bold' : 'text-gray-500' }}">
                                                        {{ $answer->is_correct ? '✓' : '○' }}
                                                    </span>
                                                    <span>{{ $answer->content }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex space-x-2">
                                <form action="{{ route('teacher.quizzes.questions.delete', $question) }}"
                                      method="POST"
                                      onsubmit="return confirm('Delete this question?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 hover:text-red-800 focus:outline-none">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('quiz', () => ({
            showQuestionForm: {{ $quiz->questions->isEmpty() ? 'true' : 'false' }}
        }));
    });
</script>
@endsection
