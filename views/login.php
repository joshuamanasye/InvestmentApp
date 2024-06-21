<?php
session_start();
require_once '../controllers/UserController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userController = new UserController();
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($userController->login($email, $password)) {
        header("Location: home.php");
        exit();
    } else {
        $error_message = "Invalid login.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../public/css/style.css">
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="login.php">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" name="action" value="Login">
    </form>
    <a href="register.php">Register</a>
    <?php
    if (isset($error_message)) {
        echo "<p style='color:red;'>$error_message</p>";
    }
    ?>
</body>
</html>
