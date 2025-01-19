<!DOCTYPE html>
<html>
<head>
    <title>Signup Page</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>
    <div class="signup-container">
        <h2>Signup</h2>
        <?php
       include('../connect.php');



        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user = mysqli_real_escape_string($conn, $_POST['username']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $pass = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $role = mysqli_real_escape_string($conn, $_POST['role']);

            $check_sql = "SELECT * FROM user WHERE email = '$email' OR username = '$user'";
            $check_result = $conn->query($check_sql);

            if ($check_result->num_rows > 0) {
                echo "<script>alert('Username or Email already exists!');</script>";
            } else {
                $sql = "INSERT INTO user (username, email, password, role) VALUES ('$user', '$email', '$pass', '$role')";

                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Registration successful! Please login to continue.');</script>";
                } else {
                    echo "<script>alert('Error: Unable to register. Please try again.');</script>";
                }
            }
            $conn->close();
        }
        ?>
        <form action="signup.php" method="post">
            <label>Username:</label>
            <input type="text" name="username" required>

            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <label>Role:</label>
            <select name="role" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>

            <button type="submit">Sign Up</button>
        </form>
    </div>
</body>
</html>
