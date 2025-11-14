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
    <p><a href="#dashboard">🖥️ Dashboard</a></p>
    <p><a href="#analytics">📊 Analytics</a></p>
    <p><a href="#data">📈 Data</a></p>
  </nav>

    <!-- Display data directly from csv file -->
    <!-- <?php
        $csvFile = 'data.csv'; // Replace with the actual path to your CSV file

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

    <!-- Display data from database -->
    <!-- <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "ewb-water-db";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        echo "Connected successfully!";

        $sql = "SELECT * FROM water_levels";
        $result = mysqli_query($conn, $sql);

        // Fetch the result data
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo '<p>';
                echo "id: " . $row["id"]. " - Timestamp: " . $row["timestamp"]. " - Water Level: " . $row["water_level"]."";
                echo '</p>';
            }
        } else {
            echo "0 results";
        }

        $conn->close();
    ?> -->




  <div id ="workspace">
    <section class="page" id="dashboard">

    </section>
  
    <section class="page" id="analytics">
        <div id = "analytics_header"> </div>
        <h2> Water Usage Analytics </h2>


        <!-- <div id = "today_usage"> 
        <p> Today's Usage </p> </div>
        <div id = "weekly_average"> 
        <p> Weekly Average </p> </div>
        <div id = "effciency"> 
        <p> Efficiency </p> </div> -->
        
        <nav id="views">
          <p><a href="#WeeklyView"> Weekly View</a></p>
          <p><a href="#MonthlyView"> Monthly View</a></p>
          <p><a href="#YearlyView"> YearlyView</a></p>
        </nav>

    </section>
    

    <section class="page" id="data">
    
    </section>
  </div>
  

  <script src="script.js"></script> 
</body>
</html>
