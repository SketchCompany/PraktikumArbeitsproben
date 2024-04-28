<?php
if (!isset($_POST['tripId'])) {
    echo "tripId data is missing.";
    exit; // Terminate script execution
}

// Retrieve the station number
$tripId = $_POST['tripId'];

// Define the test function
function trip($tripId) {
    global $dbAll;

    // Your existing test function code goes here, but with $tripId passed as an argument
    // $tbChecks = 15;
    // if (floor((time() - $lastCheck) / 1000) < $tbChecks) {
    //     echo "last check was not less than $tbChecks seconds ago, please wait";
    //     return;
    // }

    $apiUrl = 'https://v6.db.transport.rest/trips/' . $tripId . '?stopovers=true&remarks=true&polyline=false&language=en';
    
    try {
        $apiResponse = json_decode(file_get_contents($apiUrl), true);

        // Check if $apiResponse is not null
        if ($apiResponse !== null && isset($apiResponse['trip'])) {
            $dbAll = $apiResponse['trip'];

            // Output the sorted trip as JSON
            echo json_encode($dbAll); // Return the sorted trip as JSON
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
trip($tripId);

// You can add any additional processing or output here if needed
?>
