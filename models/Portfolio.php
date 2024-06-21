<?php
class Portfolio {
    public $id;
    public $userID;
    public $description;

    public function __construct($id, $userID, $description) {
        $this->id = $id;
        $this->userID = $userID;
        $this->description = $description;
    }
}
?>