<?php
require_once '../autoload.php';
require_once '../models/Portfolio.php';

class PortfolioFactory {
    public static function create($userID, $description) {
        return new Portfolio(null, $userID, $description);
    }
}
?>