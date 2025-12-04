<!-- Display data directly from csv file -->
<?php
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
?>