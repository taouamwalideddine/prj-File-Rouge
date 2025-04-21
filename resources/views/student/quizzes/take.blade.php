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
    const questions = {!! $quiz->questions->map(function($q) {
        return [
            'id' => $q->id,
            'content' => $q->content,
            'points' => $q->points,
            'answers' => $q->answers->map(function($a) {
                return [
                    'id' => $a->id,
                    'content' => $a->content
                ];
            })
        ];
    })->toJson() !!};

    let currentQuestion = 0;
    const answers = {};
    const totalQuestions = questions.length;
    const questionContainer = document.getElementById('questionContainer');
    const progressContainer = document.getElementById('progressContainer');

    // Initialize quiz
    function initQuiz() {
        updateProgress();
        showQuestion(currentQuestion);
        setupTimer();
    }

// display current
    function showQuestion(index) {
        const question = questions[index];
        const isLastQuestion = index === totalQuestions - 1;

        questionContainer.innerHTML = `
            <div class="question-card p-4 border rounded-lg mb-4">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="font-medium">Question ${index + 1}/${totalQuestions}</h3>
                    <span class="text-sm text-gray-500">${question.points} pts</span>
                </div>
                <p class="mb-4">${question.content}</p>
                <div class="space-y-2">
                    ${question.answers.map(answer => `
                        <label class="block p-2 border rounded hover:bg-gray-50 transition-colors">
                            <input type="radio"
                                   name="answers[${question.id}]"
                                   value="${answer.id}"
                                   ${answers[question.id] === answer.id ? 'checked' : ''}
                                   class="mr-2">
                            ${answer.content}
                        </label>
                    `).join('')}
                </div>
            </div>
        `;

        document.getElementById('prevBtn').classList.toggle('hidden', index === 0);
        document.getElementById('nextBtn').classList.toggle('hidden', isLastQuestion);
        document.getElementById('submitBtn').classList.toggle('hidden', !isLastQuestion);
    }

// keepup progress
    function updateProgress() {
        if (progressContainer) {
            const answeredCount = Object.keys(answers).length;
            progressContainer.innerHTML = `Progress: ${answeredCount}/${totalQuestions} answered`;
        }
    }

// navigation handlers
    function navigate(direction) {
        saveCurrentAnswer();
        currentQuestion += direction;
        showQuestion(currentQuestion);
    }

    function saveCurrentAnswer() {
        const selected = document.querySelector('input[name^="answers"]:checked');
        if (selected) {
            const questionId = selected.name.match(/\[(.*?)\]/)[1];
            answers[questionId] = selected.value;
            updateProgress();
        }
    }

// timer
    function setupTimer() {
        @if($quiz->expires_at)
        const expiryTime = new Date('{{ $quiz->expires_at }}').getTime();
        const timerElement = document.getElementById('timer');

        const updateTimer = () => {
            const now = new Date().getTime();
            const distance = expiryTime - now;

            if (distance <= 0) {
                timerElement.innerHTML = "TIME EXPIRED";
                document.getElementById('quizForm').submit();
                return;
            }

            const hours = Math.floor(distance / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            timerElement.innerHTML = `${hours}h ${minutes}m ${seconds}s remaining`;
        };

        updateTimer();
        const timer = setInterval(updateTimer, 1000);
        @endif
    }

// validation
    document.getElementById('quizForm').addEventListener('submit', function(e) {
        saveCurrentAnswer();

        if (Object.keys(answers).length < totalQuestions) {
            e.preventDefault();
            alert(`Please answer all questions before submitting.
                   You have ${totalQuestions - Object.keys(answers).length} unanswered.`);
// select unasnwered question
                   const firstUnanswered = questions.findIndex(q => !answers.hasOwnProperty(q.id));
            currentQuestion = Math.max(0, firstUnanswered);
            showQuestion(currentQuestion);
        }
    });

    document.getElementById('nextBtn').addEventListener('click', () => navigate(1));
    document.getElementById('prevBtn').addEventListener('click', () => navigate(-1));

    initQuiz();
});
</script>
@endsection
