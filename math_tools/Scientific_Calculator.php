<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Modern Scientific Calculator</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(135deg, #74ebd5 0%, #ACB6E5 100%);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Poppins', sans-serif;
    }
    .calculator {
      background: #ffffff;
      padding: 30px 25px;
      border-radius: 25px;
      box-shadow: 0px 20px 40px rgba(0,0,0,0.2);
      width: 360px;
      transition: 0.5s;
    }
    .calculator:hover {
      transform: scale(1.02);
    }
    .calculator input {
      height: 70px;
      font-size: 26px;
      text-align: right;
      border-radius: 15px;
      margin-bottom: 25px;
      background-color: #f7f7f7;
      border: none;
      box-shadow: inset 0px 2px 6px rgba(0,0,0,0.1);
    }
    .btn-calc {
      width: 70px;
      height: 70px;
      margin: 5px;
      font-size: 20px;
      font-weight: bold;
      border-radius: 18px;
      background: #f1f1f1;
      color: #333;
      border: none;
      transition: 0.3s;
      box-shadow: 0px 5px 10px rgba(0,0,0,0.05);
    }
    .btn-calc:hover {
      background: #007bff;
      color: white;
      box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
    }
    .btn-equal {
      background-color: #28a745;
      color: #fff;
    }
    .btn-equal:hover {
      background-color: #218838;
    }
    .btn-clear {
      background-color: #dc3545;
      color: #fff;
    }
    .btn-clear:hover {
      background-color: #c82333;
    }
    .btn-func {
      background: #ffb84d;
      color: white;
    }
    .btn-func:hover {
      background: #ffa31a;
    }
    .section-heading {
      text-align: center;
      font-size: 28px;
      font-weight: 700;
      margin-bottom: 20px;
      color: #333;
    }
  </style>
</head>

<body>

<div class="calculator">
  <div class="section-heading">Scientific Calculator</div>

  <form name="calc">
    <input type="text" class="form-control" name="display" id="display" readonly>

    <div class="d-flex flex-wrap justify-content-center">
      <!-- Row 1 -->
      <button type="button" class="btn btn-calc" onclick="append('7')">7</button>
      <button type="button" class="btn btn-calc" onclick="append('8')">8</button>
      <button type="button" class="btn btn-calc" onclick="append('9')">9</button>
      <button type="button" class="btn btn-func btn-calc" onclick="append('/')">÷</button>

      <!-- Row 2 -->
      <button type="button" class="btn btn-calc" onclick="append('4')">4</button>
      <button type="button" class="btn btn-calc" onclick="append('5')">5</button>
      <button type="button" class="btn btn-calc" onclick="append('6')">6</button>
      <button type="button" class="btn btn-func btn-calc" onclick="append('*')">×</button>

      <!-- Row 3 -->
      <button type="button" class="btn btn-calc" onclick="append('1')">1</button>
      <button type="button" class="btn btn-calc" onclick="append('2')">2</button>
      <button type="button" class="btn btn-calc" onclick="append('3')">3</button>
      <button type="button" class="btn btn-func btn-calc" onclick="append('-')">−</button>

      <!-- Row 4 -->
      <button type="button" class="btn btn-calc" onclick="append('0')">0</button>
      <button type="button" class="btn btn-calc" onclick="append('.')">.</button>
      <button type="button" class="btn btn-calc" onclick="append('**')">^</button>
      <button type="button" class="btn btn-func btn-calc" onclick="append('+')">+</button>

      <!-- Row 5 -->
      <button type="button" class="btn btn-calc" onclick="scientific('sin')">sin</button>
      <button type="button" class="btn btn-calc" onclick="scientific('cos')">cos</button>
      <button type="button" class="btn btn-calc" onclick="scientific('tan')">tan</button>
      <button type="button" class="btn btn-calc" onclick="scientific('sqrt')">√</button>

      <!-- Row 6 -->
      <button type="button" class="btn btn-calc" onclick="scientific('log')">log</button>
      <button type="button" class="btn btn-calc" onclick="scientific('exp')">exp</button>
      <button type="button" class="btn btn-clear btn-calc" onclick="clearDisplay()">C</button>
      <button type="button" class="btn btn-equal btn-calc" onclick="calculate()">=</button>
    </div>
  </form>
</div>

<!-- JavaScript -->
<script>
function append(value) {
  document.calc.display.value += value;
}

function clearDisplay() {
  document.calc.display.value = '';
}

function calculate() {
  try {
    document.calc.display.value = eval(document.calc.display.value);
  } catch (e) {
    alert('Invalid Expression');
  }
}

function scientific(func) {
  let value = parseFloat(document.calc.display.value);
  if (isNaN(value)) {
    alert('Please enter a valid number first.');
    return;
  }
  switch (func) {
    case 'sin':
      document.calc.display.value = Math.sin(value * Math.PI / 180).toFixed(6);
      break;
    case 'cos':
      document.calc.display.value = Math.cos(value * Math.PI / 180).toFixed(6);
      break;
    case 'tan':
      document.calc.display.value = Math.tan(value * Math.PI / 180).toFixed(6);
      break;
    case 'sqrt':
      document.calc.display.value = Math.sqrt(value).toFixed(6);
      break;
    case 'log':
      document.calc.display.value = Math.log10(value).toFixed(6);
      break;
    case 'exp':
      document.calc.display.value = Math.exp(value).toFixed(6);
      break;
  }
}
</script>

</body>
</html>
