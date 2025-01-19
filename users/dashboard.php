<?php
// Check if the 'username' is set in the URL
if (isset($_GET['username'])) {
    $username = htmlspecialchars($_GET['username']);  // Sanitize the username to avoid XSS
} else {
    echo "No username found!";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
</head>
<body>
    <h1>Welcome to the User Dashboard, <?php echo $username; ?>!</h1>
</body>
</html>
