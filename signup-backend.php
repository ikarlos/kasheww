<?php
include "./db/db_connection.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Validate password match
    if ($password !== $confirm_password) {
        echo "Passwords do not match.";
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the username or email already exists
    $stmt = $conn->prepare(
        "SELECT id FROM userdata WHERE username = ? OR email = ?"
    );
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Username or email already exists.";
        $stmt->close();
        exit();
    }

    // Insert new user into the database
    $stmt = $conn->prepare(
        "INSERT INTO userdata (username, email, password) VALUES (?, ?, ?)"
    );
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($stmt->execute()) {
        // Registration successful, start a session
        $_SESSION["user_id"] = $stmt->insert_id;
        $_SESSION["username"] = $username;
        $_SESSION["email"] = $email;

        // Redirect to index.php
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
