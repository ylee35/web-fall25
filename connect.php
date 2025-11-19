<?php
    $servername = "localhost";
    $username = "ugozuyrtgs4ye"; // tuftstuftsewb.eastafrica@gmail.com
    $password = "Abcdefghij1213."; // EWBMalawi2526*
    $dbname = "dby3hgorf87zhi";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    echo "Connected successfully!";


    $file = fopen("data.csv", "r");
    fgetcsv($file); // skip header

    while (($data = fgetcsv($file)) !== false) {
    $timestamp = $conn->real_escape_string($data[0]);
    $water_level = (float)$data[1];

    $sql = "INSERT INTO water_levels (timestamp, water_level)
            VALUES ('$timestamp', $water_level)";

    if (!$conn->query($sql)) {
        echo "Error inserting row: " . $conn->error . "<br>";
    }
    }

    fclose($file);
    $conn->close();
    echo "✅ Water level data imported successfully!";
?>
