<?php
// Database connection settings
$servername = "localhost"; // Replace with your server name
$username = "your_db_username"; // Replace with your database username
$password = "your_db_password"; // Replace with your database password
$dbname = "tutor1"; // Replace with your database name

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user input from the login form
$usernameInput = $_POST["username"];
$passwordInput = $_POST["password"];

// Query the database for the user
$sql = "SELECT * FROM users WHERE username = '$usernameInput'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User found, verify the password
    $row = $result->fetch_assoc();
    $stored_password = $row["password"];

    if ($passwordInput == $stored_password) {
        echo "Login successful!";
        // Redirect to Facebook
        header("Location: https://www.facebook.com");
        exit; // Make sure to exit to prevent further script execution
    } else {
        echo "Login failed. Please check your username and password.";
    }
} else {
    echo "Login failed. User not found.";
}

// Close the database connection
$conn->close();
?>
