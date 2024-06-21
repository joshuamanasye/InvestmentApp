<?php
require_once '../autoload.php';
require_once '../repositories/PortfolioRepository.php';
require_once '../repositories/AssetRepository.php';

class PortfolioController {
    private $portfolioRepository;
    private $assetRepository;

    public function __construct() {
        $this->portfolioRepository = new PortfolioRepository();
        $this->assetRepository = new AssetRepository();
    }

    public function createPortfolio($userID, $description) {
        $portfolio = new Portfolio(null, $userID, $description);
        return $this->portfolioRepository->createPortfolio($portfolio);
    }

    public function getPortfolios($userID) {
        return $this->portfolioRepository->getPortfoliosByUserID($userID);
    }

    public function addAsset($portfolioID, $ticker, $amount) {
        $asset = new Asset($portfolioID, $ticker, $amount);
        return $this->assetRepository->createAsset($asset);
    }

    public function getAssets($portfolioID) {
        return $this->assetRepository->getAssetsByPortfolioID($portfolioID);
    }
}
?>