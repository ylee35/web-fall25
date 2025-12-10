<?php
// --- Database connection ---
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "ewb-water-db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    http_response_code(500);
    die(json_encode(["error" => "Database connection failed"]));
}

// --- Ensure POST + JSON ---
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(["error" => "Only GET allowed"]);
    exit;
}

$raw = file_get_contents("php://input");
$data = json_decode($raw, true); // associative array

if (!$data || !isset($data["day_data"]) || !is_array($data["day_data"])) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid JSON or missing day_data array"]);
    exit;
}

// Use provided date or fallback to today
$date = isset($data["date"]) ? $data["date"] : date("Y-m-d");

// --- Tank assumptions ---
$tank_total_volume = 10000; // liters
$tank_height_cm = 200;      // total tank height in cm

$hour = 0;

foreach ($data["day_data"] as $distance_to_top) {

    // validate number
    if (!is_numeric($distance_to_top)) continue;

    // Convert distance to volume
    $water_height = max($tank_height_cm - floatval($distance_to_top), 0);
    $current_volume = ($water_height / $tank_height_cm) * $tank_total_volume;

    // Build timestamp
    $timestamp = $date . " " . str_pad($hour, 2, "0", STR_PAD_LEFT) . ":00:00";
    $hour++;

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO water_levels (timestamp, water_level) VALUES (?, ?)");
    $stmt->bind_param("sd", $timestamp, $current_volume);
    $stmt->execute();
}

echo json_encode(["status" => "ok", "rows_inserted" => $hour]);


$conn->close();
?> 
