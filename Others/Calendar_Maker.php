<?php
// Handle month and year if submitted
$month = isset($_POST['month']) ? intval($_POST['month']) : date('n');
$year = isset($_POST['year']) ? intval($_POST['year']) : date('Y');

// Current system date
$todayDay = date('j');
$todayMonth = date('n');
$todayYear = date('Y');

// Define Holidays (Add your own here)
$holidays = [
    "$year-01-01" => "New Year's Day 🎉",
    "$year-01-13" => "Lohri 🔥",
    "$year-01-14" => "Makar Sankranti 🪁",
    "$year-01-26" => "Republic Day 🇮🇳",

    "$year-02-14" => "Valentine's Day ❤️",
    "$year-02-19" => "Shivaji Jayanti ⚔️",
    
    "$year-03-08" => "International Women's Day 👩‍🦰",
    "$year-03-25" => "Holi 🌈", // (date varies - example here)
    
    "$year-04-10" => "Ram Navami 🙏", // (date varies - example)
    "$year-04-14" => "Ambedkar Jayanti 📜",
    "$year-04-21" => "Mahavir Jayanti 🕊️",
    
    "$year-05-01" => "Labour Day 👷‍♂️",
    "$year-05-23" => "Buddha Purnima 🧘‍♂️", // (date varies)
    
    "$year-06-17" => "Father's Day 👨‍👧‍👦", // (3rd Sunday of June approx)
    "$year-06-21" => "International Yoga Day 🧘‍♀️",
    
    "$year-07-06" => "Rath Yatra 🚩",
    "$year-07-21" => "Guru Purnima 🙏",
    
    "$year-08-15" => "Independence Day 🇮🇳",
    "$year-08-19" => "Raksha Bandhan 👫", // (date varies)
    "$year-08-26" => "Janmashtami 🍼",
    
    "$year-09-05" => "Teacher's Day 🍎",
    "$year-09-17" => "Vishwakarma Puja 🛠️",
    
    "$year-10-02" => "Gandhi Jayanti 🕊️",
    "$year-10-12" => "Durga Ashtami 🌺", // (example date)
    "$year-10-31" => "Halloween 🎃",
    
    "$year-11-01" => "Karva Chauth 🌙",
    "$year-11-02" => "Diwali 🪔", // (date varies)
    "$year-11-14" => "Children's Day 👶",
    "$year-11-27" => "Guru Nanak Jayanti 🛕",
    
    "$year-12-25" => "Christmas 🎄",
    "$year-12-31" => "New Year's Eve 🎊"
];


// Generate Calendar
function generateCalendar($month, $year, $todayDay, $todayMonth, $todayYear, $holidays) {
    $firstDay = mktime(0, 0, 0, $month, 1, $year);
    $daysInMonth = date('t', $firstDay);
    $dayOfWeek = date('w', $firstDay);

    $calendar = '<table class="table table-bordered text-center">';
    $calendar .= '<thead class="table-primary"><tr>';
    $daysOfWeek = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];

    foreach($daysOfWeek as $day) {
        $calendar .= "<th>{$day}</th>";
    }
    $calendar .= '</tr></thead><tbody><tr>';

    if($dayOfWeek > 0){
        $calendar .= str_repeat('<td></td>', $dayOfWeek);
    }

    $currentDay = 1;
    while($currentDay <= $daysInMonth){
        if($dayOfWeek == 7){
            $dayOfWeek = 0;
            $calendar .= '</tr><tr>';
        }

        $dateStr = sprintf('%04d-%02d-%02d', $year, $month, $currentDay);

        if(array_key_exists($dateStr, $holidays)){
            // Holiday
            $calendar .= "<td class='bg-danger text-white rounded'><strong>{$currentDay}</strong><br><small class='badge bg-warning text-dark'>{$holidays[$dateStr]}</small></td>";
        }
        elseif($currentDay == $todayDay && $month == $todayMonth && $year == $todayYear) {
            // Today
            $calendar .= "<td class='bg-success text-white rounded'><strong>{$currentDay}</strong><br><small class='badge bg-light text-dark'>Today</small></td>";
        }
        else {
            // Normal Day
            $calendar .= "<td><strong>{$currentDay}</strong></td>";
        }

        $currentDay++;
        $dayOfWeek++;
    }

    if($dayOfWeek != 7){
        $calendar .= str_repeat('<td></td>', 7 - $dayOfWeek);
    }

    $calendar .= '</tr></tbody></table>';
    return $calendar;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Calendar Maker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }
        .calendar-container {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            margin-top: 20px;
        }
        .ads-space {
            background: #e9ecef;
            padding: 20px;
            text-align: center;
            margin: 20px 0;
            border: 2px dashed #ced4da;
            font-size: 18px;
            color: #6c757d;
            border-radius: 10px;
        }
        .preview-title {
            font-weight: 600;
            font-size: 24px;
            margin-bottom: 15px;
            text-align: center;
        }
        .badge {
            font-size: 0.65rem;
        }
    </style>
</head>
<body>

<div class="container my-4">
    <!-- Top Ad Space -->
    <div class="ads-space">
        Top Ad Space (728x90)
    </div>

    <h1 class="text-center mb-4">🗓️ Calendar Maker</h1>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="calendar-container">
                <form method="POST" id="calendarForm">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Select Month:</label>
                            <select name="month" class="form-select" id="monthSelect" required>
                                <?php
                                for($m=1; $m<=12; $m++){
                                    $selected = ($m == $month) ? 'selected' : '';
                                    echo "<option value='$m' $selected>".date('F', mktime(0,0,0,$m,1))."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Select Year:</label>
                            <input type="number" name="year" id="yearInput" class="form-control" value="<?php echo $year; ?>" required min="1900" max="2100">
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Generate Calendar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Preview Section -->
    <div class="row justify-content-center mt-5">
        <div class="col-lg-8">
            <div class="calendar-container">
                <div class="preview-title">📅 Calendar Preview</div>
                <?php
                echo generateCalendar($month, $year, $todayDay, $todayMonth, $todayYear, $holidays);
                ?>
            </div>
        </div>
    </div>

    <!-- Bottom Ad Space -->
    <div class="ads-space">
        Bottom Ad Space (728x90)
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
