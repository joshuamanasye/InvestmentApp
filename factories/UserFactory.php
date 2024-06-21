<?php
require_once '../autoload.php';
require_once '../models/User.php';

class UserFactory {
    public static function create($email, $fullName, $password) {
        return new User(null, $email, $fullName, $password);
    }
}
?>