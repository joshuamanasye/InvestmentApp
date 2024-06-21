<?php
require_once '../autoload.php';
require_once '../models/User.php';
require_once '../repositories/UserRepository.php';
require_once '../repositories/RiskToleranceRepository.php';

session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$userRepository = new UserRepository();
$riskToleranceRepository = new RiskToleranceRepository();
$user = $_SESSION['user'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tolerance = $_POST['tolerance'];
    $riskToleranceRepository->setTolerance($user->id, $tolerance);
    $success_message = "Risk tolerance updated successfully.";
}

$currentTolerance = $riskToleranceRepository->getTolerance($user->id);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="../public/css/style.css">
</head>
<body>
    <h2>Profile</h2>
    <p>Email: <?php echo htmlspecialchars($user->email); ?></p>
    <p>Full Name: <?php echo htmlspecialchars($user->fullName); ?></p>

    <form method="post" action="profile.php">
        <label for="tolerance">Risk Tolerance:</label><br>
        <select id="tolerance" name="tolerance" required>
            <option value="Low" <?php if ($currentTolerance == 'Low') echo 'selected'; ?>>Low</option>
            <option value="Medium" <?php if ($currentTolerance == 'Medium') echo 'selected'; ?>>Medium</option>
            <option value="High" <?php if ($currentTolerance == 'High') echo 'selected'; ?>>High</option>
        </select><br><br>
        <input type="submit" value="Update">
    </form>
    <?php
    if (isset($success_message)) {
        echo "<p style='color:green;'>$success_message</p>";
    }
    ?>
    <a href="home.php">Back to Home</a>
</body>
</html>
