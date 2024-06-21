<?php
require_once '../autoload.php';
require_once '../config/Database.php';

class RiskToleranceRepository {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function setTolerance($userID, $tolerance) {
        $query = "INSERT INTO RiskTolerances (UserID, Tolerance) VALUES (:userID, :tolerance)
                  ON DUPLICATE KEY UPDATE Tolerance = :tolerance";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":userID", $userID);
        $stmt->bindParam(":tolerance", $tolerance);

        return $stmt->execute();
    }

    public function getTolerance($userID) {
        $query = "SELECT Tolerance FROM RiskTolerances WHERE UserID = :userID";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":userID", $userID);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['Tolerance'] : null;
    }
}
?>
