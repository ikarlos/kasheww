<?php
include("./db/db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone_no = $_POST['phone_no'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO userdata (username, password, email, phone_no) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $password, $email, $phone_no);

    if ($stmt->execute()) {
        // Get the inserted user ID
        $user_id = $stmt->insert_id;

        // Start a session
        session_start();
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;

        // Redirect to index.php
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Form submission method is not POST.";
}

$conn->close();
?>
