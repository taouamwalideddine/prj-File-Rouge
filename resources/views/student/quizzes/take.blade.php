<!-- resources/views/student/quizzes/take.blade.php -->
@extends('layouts.student')

@section('content')
<div class="container py-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">{{ $quiz->title }}</h1>
            <div class="text-gray-600">
                @if($quiz->expires_at)
                    <div id="timer" class="font-medium text-red-600"></div>
                @endif
            </div>
        </div>

        <form id="quizForm" action="{{ route('student.quizzes.submit', $quiz) }}" method="POST">
            @csrf
            <div id="questionContainer">
                <!-- Questions will be loaded here dynamically -->
            </div>

            <div class="mt-8 flex justify-between">
                <button type="button" id="prevBtn" class="bg-gray-500 text-white px-4 py-2 rounded hidden">Previous</button>
                <button type="button" id="nextBtn" class="bg-blue-600 text-white px-4 py-2 rounded">Next Question</button>
                <button type="submit" id="submitBtn" class="bg-green-600 text-white px-4 py-2 rounded hidden">Submit Quiz</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    //encode questions data
    const questions = @json($quiz->questions->map(function($q) {
        return [
            'id' => $q->id,
            'content' => $q->content,
            'points' => $q->points,
            'answers' => $q->answers->map(fn($a) => [
                'id' => $a->id,
                'content' => $a->content
            ])
        ];
    }));

    let currentQuestion = 0;
    const answers = {};
    const questionContainer = document.getElementById('questionContainer');
    const totalQuestions = questions.length;

    function showQuestion(index) {
        const question = questions[index];
        const isLast = index === totalQuestions - 1;

        let html = `
            <div class="question-card p-4 border rounded-lg mb-4">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="font-medium">
                        <span class="text-gray-500">${index + 1}/${totalQuestions}</span>
                        ${question.content}
                    </h3>
                    <span class="text-sm text-gray-500">${question.points} points</span>
                </div>
                <div class="space-y-2">`;

        question.answers.forEach(answer => {
            const isChecked = answers[question.id] === answer.id;
            html += `
                <label class="block p-2 border rounded hover:bg-gray-50 transition-colors ${isChecked ? 'bg-blue-50 border-blue-200' : ''}">
                    <input type="radio"
                           name="answers[${question.id}]"
                           value="${answer.id}"
                           ${isChecked ? 'checked' : ''}
                           class="mr-2 align-middle">
                    ${answer.content}
                </label>`;
        });

        html += `</div></div>`;
        questionContainer.innerHTML = html;

        document.getElementById('prevBtn').classList.toggle('hidden', index === 0);
        document.getElementById('nextBtn').classList.toggle('hidden', isLast);
        document.getElementById('submitBtn').classList.toggle('hidden', !isLast);
    }

    // navigation handlers
    function handleNavigation(direction) {
        const selected = document.querySelector('input[name^="answers"]:checked');
        if (!selected) {
            alert('Please select an answer before continuing!');
            return;
        }

        saveAnswer();
        currentQuestion = Math.max(0, Math.min(totalQuestions - 1, currentQuestion + direction));
        showQuestion(currentQuestion);
    }

    document.getElementById('nextBtn').addEventListener('click', () => handleNavigation(1));
    document.getElementById('prevBtn').addEventListener('click', () => handleNavigation(-1));

    // aswer tracking
    function saveAnswer() {
        const selected = document.querySelector('input[name^="answers"]:checked');
        if (selected) {
            const questionId = selected.name.match(/\[(.*?)\]/)[1];
            answers[questionId] = selected.value;
        }
    }

    // timer implementation
    @if($quiz->expires_at)
    const expiryTime = new Date('{{ $quiz->expires_at->toIso8601String() }}').getTime();

    const updateTimer = () => {
        const now = Date.now();
        const distance = expiryTime - now;

        if (distance <= 0) {
            clearInterval(timer);
            document.getElementById('timer').textContent = "TIME EXPIRED";
            document.getElementById('quizForm').submit();
            return;
        }

        const hours = Math.floor(distance / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById('timer').textContent =
            `${hours}h ${minutes}m ${seconds}s remaining`;
    };

    const timer = setInterval(updateTimer, 1000);
    updateTimer();
    @endif

    // form validation
    document.getElementById('quizForm').addEventListener('submit', function(e) {
        const unanswered = questions.filter(q => !answers.hasOwnProperty(q.id));

        if (unanswered.length > 0) {
            e.preventDefault();
            alert(`Please answer all questions! (${unanswered.length} remaining)`);
            currentQuestion = questions.findIndex(q => q.id === unanswered[0].id);
            showQuestion(currentQuestion);
        }
    });

    // initialize first question
    showQuestion(0);
});
</script>
@endsection
