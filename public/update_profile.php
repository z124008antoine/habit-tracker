<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    // Redirect to login page or show an error message
    exit('You must be logged in to edit your profile.');
}

// Include your database connection script
require_once 'database/db.php'; // Adjust this path to your actual database connection script

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assign the POST data to variables
    $newUsername = $_POST['username'];
    $newBio = $_POST['bio'];
    $userId = $_SESSION['user']; // Assuming you store user ID in session

    // Prepare an SQL statement to update user data
    $sql = "UPDATE users SET username = ?, bio = ? WHERE id = ?";

    try {
        $stmt = $conn->prepare($sql);
        // Execute the prepared statement with an array of values
        $stmt->execute([$newUsername, $newBio, $userId]);

        // Redirect to profile page or show a success message
        header("Location: profile.php");
        exit();
    } catch (PDOException $e) {
        // Handle error, e.g., show an error message
        echo "Error updating record: " . $e->getMessage();
    }
}
?>