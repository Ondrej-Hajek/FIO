<?php

// ----- REUSABLE FUNCTION ----------------------------
// Function processing the CSV files and its data and merging them in one 
// ----------------------------------------------------


function processCSV($filePath, $headers)

{
    $data = [];

    if (($file = fopen($filePath, 'r')) !== FALSE) {

        // Get the headers if not already set
        if ($headers === null) {

            $headers = fgetcsv($file, length: 0, separator: ",", enclosure: ",");
            $headers = array_map(function ($field) {
                return trim($field, ' "');
            }, $headers);
        } else {

            fgetcsv($file, length: 0, separator: ",", enclosure: ",");
            // Skip the header row
        }

        // Read and store the data rows
        while (($row = fgetcsv($file, length: 0, separator: ",", enclosure: ",")) !== FALSE) {

            $row = array_map(function ($field) {
                // Trim leading and trailing spaces and quotes
                return trim($field, ' "');
            }, $row);

            if (count($row) == count($headers)) {
                // Combine the row with the headers
                $data[] = array_combine($headers, $row);
            } else {

                $row = array_slice($row, 0, 5);

                $data[] = array_combine($headers, $row);
            }
        }

        fclose($file);
    } else {
        echo "<div class='alert alert-danger'>
        <p>Error opening the file " . basename($filePath) . ".</p>
    </div>";

        // echo "<p>Error opening the file " . basename($filePath) . ".</p>";
    }
    return $data;
}
