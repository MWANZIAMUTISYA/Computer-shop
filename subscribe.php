<?php
// Database connection variables
// Database connection details
$servername = "sql309.infinityfree.com";
$username = "if0_38050968";
$password = "M6wYPHdflK";
$dbname = "if0_38050968_user_registration2";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if email is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); // Sanitize the email input

    // Validate email format
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Prepare and bind the SQL query to insert email
        $stmt = $conn->prepare("INSERT INTO subscribers (email) VALUES (?)");
        $stmt->bind_param("s", $email); // "s" stands for string type

        if ($stmt->execute()) {
            echo "You have successfully subscribed to our newsletter!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Invalid email address.";
    }
}

$conn->close();
?>
