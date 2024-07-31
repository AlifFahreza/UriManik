<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'user') {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <script>
        window.onload = function() {
            alert('Welcome, User!');
            window.location.href = 'index.php';
        };
    </script>
</head>
</html>