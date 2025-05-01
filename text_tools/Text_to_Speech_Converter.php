<?php
// Text-to-Speech in one file
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Text to Speech Converter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background: #f4f6f9;
            font-family: 'Poppins', sans-serif;
            margin-top: 50px;
        }
        .tts-container {
            background: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: auto;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
            color: #007bff;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="tts-container">
        <h1>Text to Speech</h1>
        
        <div class="mb-3">
            <label for="textInput" class="form-label">Enter Text:</label>
            <textarea class="form-control" id="textInput" rows="5" placeholder="Type your text here..."></textarea>
        </div>

        <div class="mb-3">
            <label for="voiceSelect" class="form-label">Choose Voice:</label>
            <select class="form-select" id="voiceSelect"></select>
        </div>

        <div class="d-grid gap-2">
            <button class="btn btn-custom" onclick="speakText()">🔊 Speak Text</button>
            <button class="btn btn-secondary" onclick="stopSpeaking()">🛑 Stop</button>
        </div>
    </div>
</div>

<!-- Bootstrap Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Text to Speech JavaScript -->
<script>
let synth = window.speechSynthesis;
let voices = [];

function populateVoices() {
    voices = synth.getVoices();
    const voiceSelect = document.getElementById('voiceSelect');
    voiceSelect.innerHTML = '';

    voices.forEach((voice, index) => {
        const option = document.createElement('option');
        option.value = index;
        option.innerHTML = voice.name + (voice.default ? ' (default)' : '');
        voiceSelect.appendChild(option);
    });
}

// Populate voices when the voiceschanged event fires
if (speechSynthesis.onvoiceschanged !== undefined) {
    speechSynthesis.onvoiceschanged = populateVoices;
}

function speakText() {
    let text = document.getElementById('textInput').value;
    let utterance = new SpeechSynthesisUtterance(text);
    let selectedVoiceIndex = document.getElementById('voiceSelect').value;

    if (voices[selectedVoiceIndex]) {
        utterance.voice = voices[selectedVoiceIndex];
    }

    synth.speak(utterance);
}

function stopSpeaking() {
    if (synth.speaking) {
        synth.cancel();
    }
}
</script>

</body>
</html>
