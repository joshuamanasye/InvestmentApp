<?php
session_start();
require_once '../autoload.php';
require_once '../controllers/UserController.php';
require_once '../factories/UserFactory.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userController = new UserController();
    $email = $_POST['email'];
    $fullName = $_POST['fullname'];
    $password = $_POST['password'];

    $user = UserFactory::create($email, $fullName, $password);
    if ($userController->register($email, $fullName, $password)) {
        header("Location: login.php");
        exit();
    } else {
        $error_message = "Registration failed.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="../public/css/style.css">
</head>
<body>
    <h2>Register</h2>
    <form method="post" action="register.php">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="fullname">Full Name:</label><br>
        <input type="text" id="fullname" name="fullname" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Register">
    </form>
    <a href="login.php">Back to Login</a>
    <?php
    if (isset($error_message)) {
        echo "<p style='color:red;'>$error_message</p>";
    }
    ?>
</body>
</html>
