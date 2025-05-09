@extends('layouts.student')

@section('content')
<div class="container py-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">{{ $quiz->title }}</h1>
            @if($quiz->expires_at)
                <div id="quizTimer" class="font-medium text-red-600"></div>
            @endif
        </div>

        <form id="quizForm" action="{{ route('student.quizzes.submit', $quiz) }}" method="POST">
            @csrf
            <div id="questionContainer">
            </div>

            <div class="mt-8 flex justify-center items-center">
                <div class="relative w-16 h-16 mr-4">
                    <svg class="w-full h-full" viewBox="0 0 36 36">
                        <path
                            d="M18 2.0845
                            a 15.9155 15.9155 0 0 1 0 31.831
                            a 15.9155 15.9155 0 0 1 0 -31.831"
                            fill="none"
                            stroke="#e0e0e0"
                            stroke-width="3"
                        />
                        <path
                            id="timerCircle"
                            d="M18 2.0845
                            a 15.9155 15.9155 0 0 1 0 31.831
                            a 15.9155 15.9155 0 0 1 0 -31.831"
                            fill="none"
                            stroke="#3b82f6"
                            stroke-width="3"
                            stroke-dasharray="100, 100"
                        />
                        <text x="18" y="20" text-anchor="middle" font-size="10" fill="#333" id="timerText">10</text>
                    </svg>
                </div>

                <button type="button" id="nextBtn" class="bg-blue-600 text-white px-6 py-2 rounded-lg">
                    Next Question
                </button>
                <button type="submit" id="submitBtn" class="bg-green-600 text-white px-6 py-2 rounded-lg hidden">
                    Submit Quiz
                </button>
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
    const questionTimeLimit = 10;
    let timeLeft = questionTimeLimit;
    let questionTimer;
    const totalQuestions = questions.length;

    const questionContainer = document.getElementById('questionContainer');
    const timerCircle = document.getElementById('timerCircle');
    const timerText = document.getElementById('timerText');

    function initQuiz() {
        showQuestion(currentQuestion);
        startQuestionTimer();
    }

    function showQuestion(index) {
        clearInterval(questionTimer);
        timeLeft = questionTimeLimit;
        updateTimerDisplay();

        const question = questions[index];
        //injection dial les question
        questionContainer.innerHTML = `
            <div class="question-card p-4 border rounded-lg mb-6">
                <h3 class="font-medium mb-4">Question ${index + 1} of ${totalQuestions}</h3>
                <p class="mb-4 text-lg">${question.content}</p>
                <div class="space-y-3">
                    ${question.answers.map(answer => `
                        <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio"
                                   name="current_answer"
                                   data-question-id="${question.id}"
                                   value="${answer.id}"
                                   class="mr-3 h-5 w-5">
                            <span>${answer.content}</span>
                        </label>
                    `).join('')}
                </div>
            </div>
        `;

        if (answers[question.id]) {
            document.querySelector(`input[value="${answers[question.id]}"]`).checked = true;
        }

        document.getElementById('nextBtn').classList.toggle('hidden', index === totalQuestions - 1);
        document.getElementById('submitBtn').classList.toggle('hidden', index !== totalQuestions - 1);
    }

    function startQuestionTimer() {
        questionTimer = setInterval(() => {
            timeLeft--;
            updateTimerDisplay();

            if (timeLeft <= 0) {
                clearInterval(questionTimer);
                autoAdvance();
            }
        }, 1000);
    }

    function updateTimerDisplay() {
        const percentage = (timeLeft / questionTimeLimit) * 100;
        const dashOffset = 100 - percentage;

        timerCircle.setAttribute('stroke-dashoffset', dashOffset);
        timerText.textContent = timeLeft;

        if (timeLeft <= 3) {
            timerCircle.setAttribute('stroke', '#ef4444');
        } else if (timeLeft <= 7) {
            timerCircle.setAttribute('stroke', '#f59e0b');
        } else {
            timerCircle.setAttribute('stroke', '#3b82f6');
        }
    }

    function autoAdvance() {
        saveCurrentAnswer();
        if (currentQuestion < totalQuestions - 1) {
            currentQuestion++;
            timeLeft = questionTimeLimit;
            showQuestion(currentQuestion);
            startQuestionTimer();
        } else {
            document.getElementById('submitBtn').click();
        }
    }

    // navigation
    function saveCurrentAnswer() {
        const selected = document.querySelector('input[name="current_answer"]:checked');
        if (selected) {
            const questionId = selected.getAttribute('data-question-id');
            answers[questionId] = selected.value;
        }
    }

    function advanceQuestion() {
        saveCurrentAnswer();
        if (currentQuestion < totalQuestions - 1) {
            currentQuestion++;
            timeLeft = questionTimeLimit;
            showQuestion(currentQuestion);
            startQuestionTimer();
        }
    }

    // event listeners&
    document.getElementById('nextBtn').addEventListener('click', advanceQuestion);

    document.getElementById('quizForm').addEventListener('submit', function(e) {
        saveCurrentAnswer();

        // prepare all answers for submission
        const hiddenInputs = Object.entries(answers).map(([questionId, answerId]) => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = `answers[${questionId}]`;
            input.value = answerId;
            return input;
        });

        // clear and add new hidden inputs
        const hiddenContainer = document.createElement('div');
        hiddenInputs.forEach(input => hiddenContainer.appendChild(input));
        this.appendChild(hiddenContainer);

        if (Object.keys(answers).length < totalQuestions) {
            e.preventDefault();
            alert(`Please answer all questions before submitting.
                   ${totalQuestions - Object.keys(answers).length} remaining.`);
            currentQuestion = questions.findIndex(q => !answers.hasOwnProperty(q.id));
            showQuestion(currentQuestion);
            startQuestionTimer();
        }
    });

    // start the quiz
    initQuiz();
});
</script>
@endsection
