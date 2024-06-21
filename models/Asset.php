<?php
class Asset {
    public $portfolioID;
    public $ticker;
    public $amount;

    public function __construct($portfolioID, $ticker, $amount) {
        $this->portfolioID = $portfolioID;
        $this->ticker = $ticker;
        $this->amount = $amount;
    }
}
?>