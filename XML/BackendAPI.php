<?php
if (!isset($_POST['station'])) {
    echo "Stations data is missing.";
    exit; // Terminate script execution
}

// Retrieve the station number
$stationNr = $_POST['station'];

// Define the test function
function connections($stationNr) {
    global $dbAll;

    // Your existing test function code goes here, but with $stationNr passed as an argument
    // $tbChecks = 15;
    // if (floor((time() - $lastCheck) / 1000) < $tbChecks) {
    //     echo "last check was not less than $tbChecks seconds ago, please wait";
    //     return;
    // }

    $apiUrl = 'https://v6.db.transport.rest/stops/'.$stationNr.'/departures?duration=600&linesOfStops=false&remarks=true&language=en';

    try {
        $apiResponse = json_decode(file_get_contents($apiUrl), true);

        // Check if $apiResponse is not null
        if ($apiResponse !== null && isset($apiResponse['departures'])) {
            $dbAll = $apiResponse['departures'];

            // Sort $dbAll array based on 'plannedWhen' field
            usort($dbAll, function($a, $b) {
                return strtotime($a['plannedWhen']) - strtotime($b['plannedWhen']);
            });

            // Output the sorted departures as JSON
            echo json_encode($dbAll); // Return the sorted departures as JSON
            return; // Terminate script execution after sending JSON response
        } else {
            echo "Failed to fetch or decode API response.";
        }
    } catch (Exception $error) {
        echo 'Oops, something went wrong: ' . $error->getMessage();
        // Handle error display here
    }
}

// Call the test function with the retrieved station number
connections($stationNr);
