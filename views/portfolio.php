<?php
session_start();

// Autoload classes
require_once '../autoload.php';  // Adjust path as necessary

// Include necessary controllers
require_once '../controllers/PortfolioController.php';

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Now $_SESSION['user'] should be available after autoload
$portfolioController = new PortfolioController();
$portfolios = $portfolioController->getPortfolios($_SESSION['user']->id);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Portfolios</title>
    <link rel="stylesheet" type="text/css" href="../public/css/style.css">
</head>
<body>
    <h2>Portfolios</h2>
    <?php
    foreach ($portfolios as $portfolio) {
        echo "<h3>" . htmlspecialchars($portfolio->description) . "</h3>";
        $assets = $portfolioController->getAssets($portfolio->id);
        foreach ($assets as $asset) {
            echo "<p>" . htmlspecialchars($asset->ticker) . ": " . htmlspecialchars($asset->amount) . "</p>";
        }
    }
    ?>
    <a href="home.php">Back to Home</a>
</body>
</html>
