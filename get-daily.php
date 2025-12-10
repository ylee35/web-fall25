<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ewb-water-db";

$conn = new mysqli($servername, $username, $password, $dbname);

$date = $_GET['date'] ?? date('Y-m-d'); // default = today

$sql = "SELECT timestamp AS time, water_level AS waterlevel
        FROM water_levels
        WHERE DATE(timestamp) = ?
        ORDER BY timestamp ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $date);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
?>
