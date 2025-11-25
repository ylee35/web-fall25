<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Water Level</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header> 
    <div id="header-top">
        <img src="images/malawi_logo.png" alt="Red, black, and green waterdrop">
        <div id="header-title">
            <h1>Malawi Water Level Monitoring System</h1>
            <p>Real-time water tank monitoring for communities and organizations across Malawi</p>
        </div>
    </div>
    <div id="header-bottom">
        <img src="images/malawi_flag.png" alt="Flag of Malawi"> 
        <div id="header-subtitle">
            <h2>Tufts EWB Malawi</h2>
            <p>Water Level Monitoring</p>
        </div>
    </div>
    
  </header>

  <nav id="menu">
    <ul>
        <li>
            <button class="tab" onclick = "showPage('dashboard')">
                🖥️ Dashboard
            </button>
        </li>

        <li>
            <button class="tab" onclick = "showPage('analytics')">
                📊 Analytics
            </button>
        </li>

        <li>
            <button class="tab" onclick = "showPage('data')">
                📈 Data
            </button>
        </li>   
    </ul>
  </nav>

  <div id ="workspace">
    <div class="page" id="dashboard">
        <div class="blue-box">
            <div class="top-box">
                <div class="title-left">
                    <span>💧 Current Water Level</span>
                    <p>Last Updated</p>
                </div>

                <div class="title-right">
                    <div class="time-info">
                        <p class="label">Last Updated</p>
                        <p class="time" id="last-updated">10:45:23 AM</p> 
                        <!-- CHANGE TO PHP  -->
                    </div>

                    <span class="badge status-ok">
                        Normal
                    </span>
                </div>
            </div>
            
            <div id="bottom-box">
                <!-- <?php
// ---------------- DATABASE CONNECTION ----------------
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ewb-water-db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo "<p style='color:red;'>Database connection failed.</p>";
    exit;
}

// ---- Fetch Latest + Previous Water Level ----
$sql = "SELECT water_level, timestamp FROM water_levels ORDER BY timestamp DESC LIMIT 2";
$result = $conn->query($sql);

$current = 0;
$previous = 0;
$lastUpdated = "Unknown";

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $current = (float)$row["water_level"];
    $lastUpdated = date("g:i:s A", strtotime($row["timestamp"]));
}

if ($result && $result->num_rows > 1) {
    $row = $result->fetch_assoc();
    $previous = (float)$row["water_level"];
}

// ---- System config ----
$maxCapacity = 5.0; // meters
$percentage = ($current / $maxCapacity) * 100;
$change = $current - $previous;

// ---- UI Icons (trend indicator)
$trendIcon = "➡️";
if ($change > 0.01) $trendIcon = "⬆️";
else if ($change < -0.01) $trendIcon = "⬇️";

$conn->close();
?>

<div class="inner-bottom-box">
    <div class="text-center">
        <div class="percentage"><?php echo number_format($percentage, 1); ?>%</div>
        <div class="capacity">
            <?php echo number_format($current, 2); ?>m of <?php echo $maxCapacity; ?>m capacity
        </div>
    </div>

    <div class="progress-wrapper">
        <div class="progress-bar">
            <div class="progress-fill" style="width: <?php echo $percentage; ?>%;"></div>
        </div>
    </div>

    <div class="last-reading">
        <div class="trend-left">
            <span class="trend-icon"><?php echo $trendIcon; ?></span>
            <span class="trend-text">
                <?php echo number_format(abs($change), 2); ?>m from last reading
            </span>
        </div>
    </div>
</div>

<script>
    // Update "Last Updated" in header automatically
    document.getElementById("last-updated").innerText = "<?php echo $lastUpdated; ?>";
</script>

            </div>
        </div>
    </div>
  
    <div class="page" id="analytics" hidden>
        <div id = "analytics_header"> 
        <h2> Water Usage Analytics </h2>
        </div>

        <div id = "analytics-cards"> 
            <section class="analytics-card" id="today-usage">
                <p class="analytics-label">Weekly Average<\p>
                <p class="analytics-value">1,250<\p>
            </section>

            <section class="analytics-card" id="weekly-average">
                <p class="analytics-label">Weekly Average</p>
                <p class="analytics-value">1,150L</p>
            </section>
            
            <section class="analytics-card" id="efficiency">
                <p class="analytics-label">Efficiency</p>
                <p class="analytics-value">88%</p>
            </section>
            </div>
    </div>
        
    
                <div class="p-4">
                    <div className="flex items-center space-x-2">
                        <Activity className="w-5 h-5 text-blue-600" />
                        <div>
                            <p className="text-sm text-gray-600">
                                 <p> Today's Usage </p> </div>
                                  <p className="text-x1 font-bold">1,250L</p>
                        </div>
                    </div> -->
        <!-- </div>


        <div id = "weekly_average"> 
             <Card>
                <CardContent className="p-4">
                    <div className="flex items-center space-x-2">
                        <Activity className="w-5 h-5 text-green-600" />
                        <div>
                            <p className="text-sm text-gray-600">
                                <p> Weekly Average </p> </div>
                                  <p className="text-x1 font-bold">1,150L</p>
                        </div>
                    </div>
                </CardContent>
            </Card>
        </div>


        <div id = "efficiency"> 
            <Card>
                <CardContent className="p-4">
                    <div className="flex items-center space-x-2">
                        <BarChart3 className="w-5 h-5 text-[#CE1126]" />
                        <div>
                            <p className="text-sm text-gray-600">
                                <p> Efficiency </p> </div>
                                  <p className="text-x1 font-bold">88%</p>
                        </div>
                    </div>
                </CardContent>
            </Card>
        </div>
        

        
        <nav id="views">
          <p><a href="#WeeklyView"> Weekly View</a></p>
          <p><a href="#MonthlyView"> Monthly View</a></p>
          <p><a href="#YearlyView"> YearlyView</a></p>
        </nav>

    </div>
    

    <div class="page" id="data" hidden>
        <?php
            $csvFile = 'data.csv';

            if (!file_exists($csvFile)) {
                echo "<p>Error: CSV file not found at '$csvFile'.</p>";
            } else {
                $handle = fopen($csvFile, "r");

                if ($handle === FALSE) {
                    echo "<p>Error: Could not open the CSV file.</p>";
                } else {
                    echo '<table>';

                    // Read the header row
                    if (($header = fgetcsv($handle)) !== FALSE) {
                        echo '<thead><tr>';
                        foreach ($header as $colName) {
                            echo '<th>' . htmlspecialchars($colName) . '</th>';
                        }
                        echo '</tr></thead>';
                    }

                    echo '<tbody>';
                    // Read and display data rows
                    while (($row = fgetcsv($handle)) !== FALSE) {
                        echo '<tr>';
                        foreach ($row as $cell) {
                            echo '<td>' . htmlspecialchars($cell) . '</td>';
                        }
                        echo '</tr>';
                    }
                    echo '</tbody>';

                    echo '</table>';
                    fclose($handle);
                }
            }
        ?> -->
    </div>
  </div>
  

  <script src="index.js"></script> 
</body>
</html>
