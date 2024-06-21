<?php
require_once '../autoload.php';
require_once '../models/User.php';
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="../public/css/style.css">
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user']->fullName); ?></h2>
    <a href="profile.php">Profile</a>
    <a href="portfolio.php">Portfolios</a>
    <a href="logout.php">Logout</a>
</body>
</html>
