<?php
class User {
    public $id;
    public $email;
    public $fullName;
    public $password;

    public function __construct($id, $email, $fullName, $password) {
        $this->id = $id;
        $this->email = $email;
        $this->fullName = $fullName;
        $this->password = $password;
    }
}
?>