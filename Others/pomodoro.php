<?php
// pomodoro.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pomodoro Timer</title>
  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome for Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    body {
      background: #f8f9fa;
      font-family: 'Poppins', sans-serif;
    }
    .timer {
      font-size: 5rem;
      font-weight: bold;
      color: #0d6efd;
    }
    .btn-custom {
      width: 120px;
    }
    .ad-space {
      background: #e9ecef;
      height: 100px;
      border: 2px dashed #ced4da;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #6c757d;
      font-weight: bold;
      font-size: 1.2rem;
    }
    .timer-card {
      background: #fff;
      border-radius: 20px;
      padding: 40px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
  </style>

</head>
<body>

<div class="container py-5">
  <h1 class="text-center mb-4">⏳ Pomodoro Timer</h1>

  <!-- Ad Space Top -->
  <div class="ad-space mb-4">
    Ad Space 728x90
  </div>

  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="timer-card text-center">
        <div id="timer" class="timer">25:00</div>
        <div class="mt-4">
          <button id="startBtn" class="btn btn-success btn-custom me-2"><i class="fas fa-play"></i> Start</button>
          <button id="pauseBtn" class="btn btn-warning btn-custom me-2" disabled><i class="fas fa-pause"></i> Pause</button>
          <button id="resetBtn" class="btn btn-danger btn-custom"><i class="fas fa-undo"></i> Reset</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Ad Space Bottom -->
  <div class="ad-space mt-5">
    Ad Space 728x90
  </div>

</div>

<!-- Bootstrap JS & Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Pomodoro Timer Logic
let workMinutes = 25;
let breakMinutes = 5;
let seconds = 0;
let isRunning = false;
let timerInterval;

const timerDisplay = document.getElementById('timer');
const startBtn = document.getElementById('startBtn');
const pauseBtn = document.getElementById('pauseBtn');
const resetBtn = document.getElementById('resetBtn');

function updateDisplay() {
  let displayMinutes = workMinutes.toString().padStart(2, '0');
  let displaySeconds = seconds.toString().padStart(2, '0');
  timerDisplay.textContent = `${displayMinutes}:${displaySeconds}`;
}

function startTimer() {
  if (!isRunning) {
    isRunning = true;
    startBtn.disabled = true;
    pauseBtn.disabled = false;

    timerInterval = setInterval(() => {
      if (seconds === 0) {
        if (workMinutes === 0) {
          clearInterval(timerInterval);
          timerDisplay.textContent = "Break!";
          timerDisplay.classList.remove('text-primary');
          timerDisplay.classList.add('text-success');
          alert("Time for a break!");
          return;
        } else {
          workMinutes--;
          seconds = 59;
        }
      } else {
        seconds--;
      }
      updateDisplay();
    }, 1000);
  }
}

function pauseTimer() {
  if (isRunning) {
    isRunning = false;
    clearInterval(timerInterval);
    startBtn.disabled = false;
    pauseBtn.disabled = true;
  }
}

function resetTimer() {
  isRunning = false;
  clearInterval(timerInterval);
  workMinutes = 25;
  seconds = 0;
  updateDisplay();
  startBtn.disabled = false;
  pauseBtn.disabled = true;
  timerDisplay.classList.remove('text-success');
  timerDisplay.classList.add('text-primary');
}

startBtn.addEventListener('click', startTimer);
pauseBtn.addEventListener('click', pauseTimer);
resetBtn.addEventListener('click', resetTimer);

updateDisplay(); // Initial Display
</script>

</body>
</html>
