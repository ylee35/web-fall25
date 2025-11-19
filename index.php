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
            <button class="tab" onclick = "showPage('dashboard')">🖥️ Dashboard
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
        <p> this is dashboard content </p>
        <div class="full-screen-box">
            <h1>Live Data Feed</h1>
        </div>
    </div>
  
    <div class="page" id="analytics" hidden>
        <div id = "analytics_header"> 
        <h2> Water Usage Analytics </h2>
        </div>


        <div id = "today_usage"> 
        <p> Today's Usage </p> </div>
        <div id = "weekly_average"> 
        <p> Weekly Average </p> </div>
        <div id = "effciency"> 
        <p> Efficiency </p> </div>
        
        <nav id="views">
          <p><a href="#WeeklyView"> Weekly View</a></p>
          <p><a href="#MonthlyView"> Monthly View</a></p>
          <p><a href="#YearlyView"> YearlyView</a></p>
        </nav>

    </div>
    

    <div class="page" id="data" hidden>
        <p>data content</p>
    </div>
  </div>
  

  <script src="index.js"></script> 
</body>
</html>
