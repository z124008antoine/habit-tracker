<?php
require_once 'database/db.php';

if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Check if username or email already exists
        $query = "SELECT COUNT(*) FROM users WHERE username = :username OR email = :email";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count > 0) {
                header("refresh:2;url=registration_form.php");
                echo "Username or email already in use. Go back to <a href='registration_form.php'>Registration</a>";
                $documentTitle = 'Registration_Failed'; // Set the title of the document for the layout
        } else {
                // Hash the password
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // Insert user into the database
                $query = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $hashedPassword);

                if ($stmt->execute()) {
                        header("refresh:2;url=login.php");
                        echo "Registration successful! You can now <a href='login.php'>login</a>.";
                        $documentTitle = 'Registration_Successfull'; // Set the title of the document for the layout
                } else {
                        header("refresh:4;url=registration_form.php");
                        echo "Error: " . $stmt->errorInfo()[2];#
                        $documentTitle = 'Registration_Failed'; // Set the title of the document for the layout
                }
        }
}

include 'layout/layout_no_nav.php';
?>