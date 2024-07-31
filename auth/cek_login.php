<?php
session_start();
include '../config.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the user exists in the database
    $query = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $query->bind_param("ss", $username, $password); // Assuming password is stored as plain text in database
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role']; // 'user' or 'admin'

        // Redirect based on user role
        if ($user['role'] == 'admin') {
            header("Location: ../admin/admin_dashboard.php");
        } else {
            header("Location: ../user_dashboard.php");
        }
        exit();
    } else {
        echo "Invalid username or password.";
    }
}
?>
