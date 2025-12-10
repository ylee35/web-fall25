<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Water Level</title>
  <link rel="stylesheet" href="styles.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>

<body>
  <header> 
    <div id="header-top">
        <img src="images/malawi_transparent_logo.png" alt="Red, black, and green waterdrop">
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

  <nav id="nav-menu" class="menu">
    <ul>
        <li>
            <button class="tab active" onclick = "switchMainPage('dashboard')">
                🖥️ Dashboard
            </button>
        </li>

        <li>
            <button class="tab" onclick = "switchMainPage('analytics')">
                📊 Analytics
            </button>
        </li>

        <li>
            <button class="tab" onclick = "switchMainPage('data')">
                📈 Data
            </button>
        </li>   
    </ul>
  </nav>

  <div id ="workspace">
    <!-- START OF DASHBOARD -->
    <div class="page" id="dashboard">
        <div class="blue-box">
            <div class="top-box">
                <div class="title-left">
                    <span>💧 Current Water Level</span>
                </div>

                <div class="title-right">
                    <div class="time-info">
                        <p class="label">Last Updated</p>
                        <p class="time" id="last-updated"></p> 
                    </div>

                    <span class="badge status-ok">
                        Normal
                    </span>
                </div>
            </div>
            
            <div id="bottom-box">
                <?php
                    // ---------------- DATABASE CONNECTION ----------------
                    $servername = "localhost";
                    $username = "uxiekbidj51ac";
                    $password = "EWBWeb25";
                    $dbname = "dbfrlyt8lkduus";

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
                    $maxCapacity = 10000; // LITERS
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
                            <?php echo number_format($current, 2); ?>L of <?php echo $maxCapacity; ?>L capacity
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
                                <?php echo number_format(abs($change), 2); ?>L from last reading
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
    <!-- END OF DASHBOARD -->
  
    <div class="page" id="analytics" hidden>
        <div id = "page-header"> 
            <h2> Water Usage Analytics </h2>
        </div>

        <div id = "analytics-cards"> 
            <section class="analytics-card" id="today-usage">
                <p class="analytics-label">Today's Usage</p>
                <p class="analytics-value">1,250</p>
            </section>

            <section class="analytics-card" id="today-max">
                <p class="analytics-label">Today's Maximum Level</p>
                <p class="analytics-value">1,300L</p>
                <p class="analytics-time">6:00 pm</p>
            </section>

            <section class="analytics-card" id="today-min">
                <p class="analytics-label">Today's Minimum</p>
                <p class="analytics-value">1,150L</p>
                <p class="analytics-time">5:00 am</p>

            </section>

            <section class="analytics-card" id="weekly-average">
                <p class="analytics-label">Weekly Average</p>
                <p class="analytics-value">1,150L</p>
            </section>
        </div>
        
        <nav id="analytics-menu" class="menu">
            <ul>
                <li>
                    <button class="tab" onclick = "showPage('daily')">
                        Daily View
                    </button>
                </li>

                <li>
                    <button class="tab" onclick = "showPage('weekly')">
                        Weekly View
                    </button>
                </li>

                <li>
                    <button class="tab" onclick = "showPage('monthly')">
                        Monthly View
                    </button>
                </li>  
                
                <li>
                    <button class="tab" onclick = "showPage('yearly')">
                        Yearly View
                    </button>
                </li>  
            </ul>
        </nav>

        <div class="analytics-page" id="daily">
            <div class="graph-box">
                <div class="top-box">
                    <div class="title-left">
                        Hourly Water Level Trends
                    </div>

                    <div class="right-date">
                        <button class="date-button" id="prevDay">◀</button>
                        <div id="chart-date"></div>
                        <button class="date-button" id="nextDay">▶</button>
                    </div>
                </div>
            
                <canvas id="waterChart" width="700" height="300"></canvas>
                    
                <script>
                let chart;
                let currentDate = new Date();
                
                const today = new Date();
                today.setHours(0,0,0,0);
                function stripTime(d) {
                    const x = new Date(d);
                    x.setHours(0,0,0,0);
                    return x;
                }

                function formatDate(date) {
                return date.toISOString().split("T")[0];
                }

                function loadChart(dateString) {
                document.getElementById("chart-date").innerText = dateString;

                fetch("get-daily.php?date=" + dateString)
                    .then(res => res.json())
                    .then(data => {
                    const times = data.map(d => d.time.substring(11, 16)); // HH:MM
                    const levels = data.map(d => d.waterlevel);

                    if (chart) chart.destroy();

                    chart = new Chart(document.getElementById("waterChart"), {
                        type: "line",
                        data: {
                        labels: times,
                        datasets: [{
                            label: "Water Level (m)",
                            data: levels,
                            backgroundColor: "rgba(0,128,0,0.15)",
                            borderColor: "green",
                            borderWidth: 2,
                            fill: true,
                            tension: 0.4
                        }]
                        },
                        options: {
                            plugins: {
                                legend: {
                                    display: false  
                                }
                            },
                            scales: {
                                x: { 
                                    title: { display: true, text: "Time" }, 
                                    grid: { display: false } },
                                y: { 
                                    title: { display: true, text: "Water Level (L)" }, 
                                    grid: { display: false },
                                    min: 0,          // force y-axis to start at 0
                                    max: 10000,      // force y-axis to end at tank capacity
                                    ticks: {
                                        stepSize: 1000 // optional: nicer spacing
                                    }
                                }
                            }
                
                        }
                    });
                    });
                }

                document.getElementById("prevDay").onclick = () => {
                    currentDate.setDate(currentDate.getDate() - 1);
                    loadChart(formatDate(currentDate));
                };

                document.getElementById("nextDay").onclick = () => {
                    const next = new Date(currentDate);
                    next.setDate(next.getDate() + 1);

                    // Prevent going beyond today's date
                    if (stripTime(next) > today) return;

                    currentDate = next;
                    loadChart(formatDate(currentDate));
                };

                // Load today's chart on page load
                loadChart(formatDate(currentDate));
                </script>
            </div>
        </div>

        <div class="analytics-page" id="weekly" hidden>
            <div class="graph-box">
                <div class="graph-box">
                <div class="top-box">
                    <div class="title-left">
                        Weekly Water Level Trends
                    </div>

                    <div class="right-date">
                        <button class="date-button" id="prevDay">◀</button>
                        <div id="chart-date"></div>
                        <button class="date-button" id="nextDay">▶</button>
                    </div>
                </div>
            
                <canvas id="waterChart" width="700" height="300"></canvas>
            </div>
        </div>

        <div class="analytics-page" id="monthly" hidden>
            <div class="graph-box">
                <div class="top-box">
                    <div class="title-left">
                        Monthlyu Water Level Trends
                    </div>

                    <div class="right-date">
                        <button class="date-button" id="prevDay">◀</button>
                        <div id="chart-date"></div>
                        <button class="date-button" id="nextDay">▶</button>
                    </div>
                </div>
        </div>

        <div class="analytics-page" id="yearly" hidden>
            <div class="graph-box">
                Coming Soon
            </div>
        </div>

    </div>
    
    <div class="page" id="data" hidden>
        <div id = "page-header"> 
            <h2>Cumulative Data</h2>
        </div>

        <div class="data-inner-box">
            <?php
                // ---------------- DATABASE CONNECTION ----------------
                $servername = "localhost";
                $username = "uxiekbidj51ac";
                $password = "EWBWeb25";
                $dbname = "dbfrlyt8lkduus";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    echo "<p style='color:red;'>Database connection failed.</p>";
                    exit;
                }

                // ---- Fetch ALL water level data ----
                $sql = "SELECT timestamp, water_level FROM water_levels ORDER BY timestamp DESC";
                $result = $conn->query($sql);

                // ---- Function to determine status label ----
                function statusLabel($level) {
                    if ($level <= 1.5) {
                        return "<span class='status low'>Low</span>";
                    } else if ($level <= 2.0) {
                        return "<span class='status moderate'>Moderate</span>";
                    } else {
                        return "<span class='status optimal'>Optimal</span>";
                    }
                }
                ?>

                <!-- TABLE STRUCTURE -->
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Timestamp</th>
                            <th>Water Level</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $time = date("Y-m-d H:i", strtotime($row["timestamp"]));
                                $level = number_format($row["water_level"], 1) . "L";
                                $status = statusLabel((float)$row["water_level"]);

                                echo "<tr>
                                        <td>$time</td>
                                        <td>$level</td>
                                        <td>$status</td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3' style='text-align:center;'>No data available.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <?php $conn->close(); ?>
        </div>
    </div>
  </div>
  

  <script src="index.js"></script> 
</body>

</html>