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

// Check if a projectis sent via GET
if (isset($_GET['country'])) {
    $country_name = $_GET['country'];

    // Check if a projectwas found
    if ($country_name) {
       
        // Query to get projects based on the projectID
        $stmt = $pdo->prepare("SELECT id, name FROM projects WHERE hub = :project");
        $stmt->execute(['project' => $country_name ]);

        // Fetch the results as an associative array
        $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Return the list of projects as a JSON response
        echo json_encode($projects);
    } else {
        // Return an error if the projectwas not found
        echo json_encode(['error' => 'project not found']);
    }
} else {
    // Return an error if no projectis selected
    echo json_encode(['error' => 'No project selected']);
}
?>
