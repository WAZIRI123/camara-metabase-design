<?php
// Database connection
$host = "localhost";  // Database host (usually localhost)
$dbname = "test";     // Database name
$username = "root";   // Database username
$password = "";       // Database password


// Create a new PDO connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set PDO to throw exceptions on error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Check if a country is sent via GET
if (isset($_GET['country'])) {
    $country = $_GET['country'];
    // Check if a country was found
    if ($country) {
        // Query to get schools based on the country ID
        $stmt = $pdo->prepare("SELECT distinct id, sc_name FROM schools WHERE sc_country = :sc_country");
        $stmt->execute(['sc_country' => $country]);

        // Fetch the results as an associative array
        $schools = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Return the list of schools as a JSON response
        echo json_encode($schools);
    } else {
        // Return an error if the country was not found
        echo json_encode(['error' => 'Country not found']);
    }
} else {
    // Return an error if no country is selected
    echo json_encode(['error' => 'No country selected']);
}
?>
