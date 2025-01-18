<?php
// Database connection
include("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    // Check if the email or username already exists
    $check_sql = "SELECT * FROM user WHERE email = '$email' OR username = '$user'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        // Instead of echoing alert directly, handle it more gracefully (optionally store error message in a session and display on the next page)
        header("Location: signup.php?error=username_email_exists");
        exit();
    } else {
        // Insert data into the database
        $sql = "INSERT INTO user (username, email, password, role) VALUES ('$user', '$email', '$pass', '$role')";

        if ($conn->query($sql) === TRUE) {
            // Redirect based on role
            if ($role == "user") {
                header("Location: users/dashboard.php");
                exit();
            } elseif ($role == "admin") {
                header("Location: admin/dashboard.php");
                exit();
            }
        } else {
            // Handle insertion error and redirect back with an error message
            header("Location: signup.php?error=registration_failed");
            exit();
        }
    }

    // Close the database connection
    $conn->close();
}
?>
