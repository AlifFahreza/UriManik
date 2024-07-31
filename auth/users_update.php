<?php
include '../config.php'; // Include your database connection file

// Data pengguna yang akan dimasukkan
$users = [
    ['username' => 'admin', 'password' => 'admin123', 'role' => 'admin'],
    ['username' => 'user', 'password' => 'user123', 'role' => 'user']
];

foreach ($users as $user) {
    // Check if the username already exists
    $checkQuery = $conn->prepare("SELECT username FROM users WHERE username = ?");
    $checkQuery->bind_param("s", $user['username']);
    $checkQuery->execute();
    $result = $checkQuery->get_result();

    if ($result->num_rows == 0) {
        // Hash the password before storing it in the database
        $hashed_password = password_hash($user['password'], PASSWORD_DEFAULT);

        $insertQuery = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        $insertQuery->bind_param("sss", $user['username'], $hashed_password, $user['role']);
        $insertQuery->execute();
    } else {
        echo "Username " . $user['username'] . " already exists.<br>";
    }
}

echo "Users added successfully.";
?>
