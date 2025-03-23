<?php
include "./db/db_connection.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST["password"];
    $email = $_POST["email"]; // Add email field

    // Prepare and bind
    $stmt = $conn->prepare(
        "SELECT id, username, password, email FROM userdata WHERE email = ?"
    );
    $stmt->bind_param("s", $email); // Bind both username and email
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($user_id, $username, $hashed_password, $email);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            // Password is correct, start a session
            $_SESSION["user_id"] = $user_id;
            $_SESSION["username"] = $username;
            $_SESSION["email"] = $email;

            // Redirect to index.php
            header("Location: index.php");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that username or email.";
    }

    $stmt->close();
}

$conn->close();
?>
