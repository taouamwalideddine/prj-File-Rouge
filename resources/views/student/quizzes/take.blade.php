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

            <!-- Hidden inputs for storing answers -->
            <div id="hiddenAnswers"></div>

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
    const timeSpent = {};
    const questionTimeLimit = 10;
    let questionTimer;
    let timeLeft = questionTimeLimit;
    const totalQuestions = questions.length;
    let quizStartTime = Date.now();

    const questionContainer = document.getElementById('questionContainer');
    const timerBar = document.getElementById('timerBar');
    const timeBonusDisplay = document.getElementById('timeBonus');
    const basePointsDisplay = document.getElementById('basePoints');
    const totalPointsDisplay = document.getElementById('totalPoints');

    function initQuiz() {
        showQuestion(currentQuestion);
        startQuestionTimer();
        updatePointsDisplay(0, 0);
    }

    function showQuestion(index) {
        clearInterval(questionTimer);
        timeLeft = questionTimeLimit;
        updateTimerBar();

        const question = questions[index];
        questionContainer.innerHTML = `
            <div class="question-card p-4 border rounded-lg mb-4">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="font-medium">Question ${index + 1}/${totalQuestions}</h3>
                    <span class="text-sm text-gray-500">Base: ${question.points} pts</span>
                </div>
                <div class="h-2 bg-gray-200 rounded-full mb-4">
                    <div id="timerBar" class="h-full bg-blue-600 rounded-full" style="width:100%"></div>
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
        document.getElementById('nextBtn').classList.toggle('hidden', index === totalQuestions - 1);
        document.getElementById('submitBtn').classList.toggle('hidden', index !== totalQuestions - 1);
    }

    function startQuestionTimer() {
        clearInterval(questionTimer);
        timeLeft = questionTimeLimit;
        updateTimerBar();

        questionTimer = setInterval(() => {
            timeLeft--;
            updateTimerBar();

            if (timeLeft <= 0) {
                clearInterval(questionTimer);
                if (currentQuestion < totalQuestions - 1) {
                    navigate(1);
                } else {
                    document.getElementById('submitBtn').click();
                }
            }
        }, 1000);
    }

    function updateTimerBar() {
        const percentage = (timeLeft / questionTimeLimit) * 100;
        const color = percentage > 50 ? 'bg-blue-600' :
                     percentage > 25 ? 'bg-yellow-500' : 'bg-red-500';

        timerBar.className = `h-full ${color} rounded-full transition-all duration-1000`;
        timerBar.style.width = `${percentage}%`;
    }

    function calculateTimeBonus(timeSpent, basePoints) {
        const maxBonus = basePoints * 0.5;
        const bonus = Math.max(0, maxBonus * (1 - (timeSpent / questionTimeLimit)));
        return Math.round(bonus);
    }

    function updatePointsDisplay(basePoints, bonusPoints) {
        basePointsDisplay.textContent = basePoints;
        timeBonusDisplay.textContent = bonusPoints;
        totalPointsDisplay.textContent = basePoints + bonusPoints;
    }

    function navigate(direction) {
        saveCurrentAnswer();
        currentQuestion += direction;
        showQuestion(currentQuestion);
        startQuestionTimer();
    }

    function saveCurrentAnswer() {
        const selected = document.querySelector('input[name^="answers"]:checked');
        if (selected) {
            const questionId = selected.name.match(/\[(.*?)\]/)[1];
            answers[questionId] = selected.value;
            timeSpent[questionId] = questionTimeLimit - timeLeft;

            const question = questions[currentQuestion];
            const bonus = calculateTimeBonus(timeSpent[questionId], question.points);
            updatePointsDisplay(question.points, bonus);
        }
    }

    document.getElementById('quizForm').addEventListener('submit', function(e) {
        saveCurrentAnswer();

        if (Object.keys(answers).length < totalQuestions) {
            e.preventDefault();
            alert(`Please answer all questions before submitting.
                   You have ${totalQuestions - Object.keys(answers).length} unanswered.`);
            currentQuestion = questions.findIndex(q => !answers.hasOwnProperty(q.id));
            showQuestion(currentQuestion);
        } else {
            const timeBonusInput = document.createElement('input');
            timeBonusInput.type = 'hidden';
            timeBonusInput.name = 'time_bonus';
            timeBonusInput.value = JSON.stringify(timeSpent);
            this.appendChild(timeBonusInput);
        }
    });

    initQuiz();
});
</script>
