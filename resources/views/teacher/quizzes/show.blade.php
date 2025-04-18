@extends('layouts.teacher')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-semibold">{{ $quiz->title }}</h2>
            <p class="text-gray-600">{{ $quiz->description }}</p>
            <p class="text-sm text-gray-500 mt-1">
                Created: {{ $quiz->created_at->format('M d, Y') }} |
                Type: {{ strtoupper($quiz->type) }}
            </p>
        </div>
        <div>
<a href="{{ route('teacher.quizzes') }}" class="text-indigo-600 hover:underline">Back to Quizzes</a>        </div>
    </div>

    <div class="mt-8">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold">Questions</h3>
            <button @click="showQuestionForm = !showQuestionForm"
                    class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                Add Question
            </button>
        </div>

        <!-- Add Question Form (Hidden by default) -->
        <div x-show="showQuestionForm" x-transition class="mb-8 p-4 border rounded-lg">
            <form action="{{ route('teacher.quizzes.questions.store', $quiz) }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Question Text</label>
                        <textarea name="content" rows="3" required
                                  class="w-full p-2 border rounded"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Points</label>
                        <input type="number" name="points" min="1" value="1" required
                               class="w-full p-2 border rounded">
                    </div>

                    <!-- Answers Section -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium mb-1">Answers</label>
                        @if($quiz->type === 'mcq')
    @for($i = 0; $i < 4; $i++)
        <div class="flex items-center">
            <input type="radio" name="correct_answer" value="{{ $i }}"
                   {{ $i === 0 ? 'checked' : '' }}
                   class="mr-2">
            <input type="text" name="answers[]" required
                   placeholder="Answer option {{ $i+1 }}"
                   class="flex-1 p-2 border rounded">
        </div>
    @endfor
@else
    <!-- True/False Answers -->
    <input type="hidden" name="answers[]" value="True">
    <input type="hidden" name="answers[]" value="False">
    <div class="flex items-center">
        <input type="radio" name="correct_answer" value="0" checked class="mr-2">
        <span>True</span>
    </div>
    <div class="flex items-center">
        <input type="radio" name="correct_answer" value="1" class="mr-2">
        <span>False</span>
    </div>
@endif
                    </div>

                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                        Save Question
                    </button>
                </div>
            </form>
        </div>

        @if($quiz->questions->isEmpty())
            <p class="text-gray-500">No questions added yet.</p>
        @else
            <div class="space-y-4">
                @foreach($quiz->questions as $question)
                    <div class="border rounded-lg p-4">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <h4 class="font-medium">{{ $question->content }}</h4>
                                <p class="text-sm text-gray-500">{{ $question->points }} points</p>

                                <div class="mt-2 space-y-1">
                                    @foreach($question->answers as $answer)
                                        <div class="flex items-center">
                                            <span class="mr-2 {{ $answer->is_correct ? 'text-green-500 font-bold' : 'text-gray-500' }}">
                                                {{ $answer->is_correct ? '✓' : '○' }}
                                            </span>
                                            <span>{{ $answer->answer_text }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="flex space-x-2">
                                <button @click="editQuestion({{ $question->id }})"
                                        class="text-indigo-600 hover:text-indigo-800">
                                    Edit
                                </button>
                                <form action="{{ route('teacher.quizzes.questions.delete', $question) }}"
                                      method="POST"
                                      onsubmit="return confirm('Delete this question?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">
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
            showQuestionForm: false,
            editQuestion(questionId) {

                console.log('Editing question:', questionId);
            }
        }));
    });
</script>
@endsection
