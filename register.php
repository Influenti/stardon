<?php
// Database connection settings
$servername = "localhost"; // Replace with your server name
$username = "your_db_username"; // Replace with your database username
$password = ""; // Leave the password empty for no password
$dbname = "tutor1"; // Replace with your database name

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user input from the registration form
$usernameInput = $_POST["username"];
$contactInput = $_POST["contact"];
$emailInput = $_POST["email"];
$passwordInput = $_POST["password"];

// Check if the username already exists in the database
$check_username_sql = "SELECT * FROM users WHERE username = '$usernameInput'";
$check_username_result = $conn->query($check_username_sql);

// Check if the contact already exists in the database
$check_contact_sql = "SELECT * FROM users WHERE contact = '$contactInput'";
$check_contact_result = $conn->query($check_contact_sql);

// Check if the email already exists in the database
$check_email_sql = "SELECT * FROM users WHERE email = '$emailInput'";
$check_email_result = $conn->query($check_email_sql);

if ($check_username_result->num_rows > 0) {
    // User with the same username already exists
    echo "Username already exists. Please choose a different username.";
} elseif ($check_contact_result->num_rows > 0) {
    // User with the same contact already exists
    echo "Contact already exists. Please provide a different contact.";
} elseif ($check_email_result->num_rows > 0) {
    // User with the same email already exists
    echo "Email already exists. Please provide a different email.";
} else {
    // Insert user data into the database
    $sql = "INSERT INTO users (username, contact, email, password) VALUES ('$usernameInput', '$contactInput', '$emailInput', '$passwordInput')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful. <a href='login.html'>Login</a>";
        // Redirect to Facebook
        header("Location: https://www.facebook.com");
        exit; // Make sure to exit to prevent further script execution
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
