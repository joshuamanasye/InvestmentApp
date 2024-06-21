<?php
require_once '../autoload.php';
require_once '../config/Database.php';
require_once '../models/Portfolio.php';

class PortfolioRepository {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function createPortfolio($portfolio) {
        $query = "INSERT INTO Portfolios (UserID, PortfolioDescription) VALUES (:userID, :description)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":userID", $portfolio->userID);
        $stmt->bindParam(":description", $portfolio->description);

        if ($stmt->execute()) {
            $portfolio->id = $this->conn->lastInsertId();
            return true;
        }
        return false;
    }

    public function getPortfoliosByUserID($userID) {
        $query = "SELECT * FROM Portfolios WHERE UserID = :userID";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":userID", $userID);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Portfolio');
    }
}
?>