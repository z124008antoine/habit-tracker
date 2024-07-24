<?php
// Start the session
session_start();

$updateSuccessful = false;

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    // Redirect to login page or show an error message
    exit('You must be logged in to edit your profile.');
}

// Include your database connection script
require_once 'database/db.php'; // Adjust this path to your actual database connection script

// Check if the request is an AJAX POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Extract and sanitize the data from the POST request
    $avatar_skin_color = filter_input(INPUT_POST, 'avatar_skin_color', FILTER_SANITIZE_STRING);
    $avatar_hair_color = filter_input(INPUT_POST, 'avatar_hair_color', FILTER_SANITIZE_STRING);
    $avatar_hair_style = filter_input(INPUT_POST, 'avatar_hair_style', FILTER_SANITIZE_STRING);

    // Prepare the SQL statement to update the user's avatar selections
    $sql = "UPDATE users SET avatar_skin_color = :avatar_skin_color, avatar_hair_color = :avatar_hair_color, avatar_hair_style = :avatar_hair_style WHERE id = :user_id";
    $stmt = $conn->prepare($sql);
    
    // Bind the parameters and execute the statement
    if($stmt->execute([
        ':avatar_skin_color' => $avatar_skin_color,
        ':avatar_hair_color' => $avatar_hair_color,
        ':avatar_hair_style' => $avatar_hair_style,
        ':user_id' => $_SESSION['user']
    ])) {
        $updateSuccessful = true;
    } else {
        // Handle the error or show an error message
        $updateSuccessful = false;
    }

    // Respond to the client based on whether the update was successful
    if ($updateSuccessful) {
        $_SESSION['pfp'] = "images/avatars/" . $avatar_skin_color . "/" . $avatar_hair_color . "/" . $avatar_hair_style . ".png";
        echo json_encode(['success' => true, 'message' => 'Avatar updated successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update avatar.']);
    }    
    exit; // Stop script execution after AJAX request is processed
}
?>