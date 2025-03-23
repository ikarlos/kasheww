<?php
session_start(); // Start the session

// Check if the user is logged in and has the role of "admin"
if (!isset($_SESSION["user_id"])) {
    header("Location: ../login-page.php"); // Redirect to login page if not logged in
    exit();
}

include "../db/db_connection.php";

// Fetch the user's role from the database
$user_id = $_SESSION["user_id"];
$sql = "SELECT role FROM userdata WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($role);
$stmt->fetch();
$stmt->close();

if ($role !== "admin") {
    header("Location: ../index.php"); // Redirect to home page if not an admin
    exit();
}
?>
