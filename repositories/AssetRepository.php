<?php
require_once '../autoload.php';
require_once '../config/Database.php';
require_once '../models/Asset.php';

class AssetRepository {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function createAsset($asset) {
        $query = "INSERT INTO Assets (PortfolioID, Ticker, Amount) VALUES (:portfolioID, :ticker, :amount)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":portfolioID", $asset->portfolioID);
        $stmt->bindParam(":ticker", $asset->ticker);
        $stmt->bindParam(":amount", $asset->amount);

        return $stmt->execute();
    }

    public function getAssetsByPortfolioID($portfolioID) {
        $query = "SELECT * FROM Assets WHERE PortfolioID = :portfolioID";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":portfolioID", $portfolioID);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Asset');
    }
}
?>