<?php
require_once '../autoload.php';
require_once '../config/Database.php';
require_once '../models/User.php';

class UserRepository {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function createUser($user) {
        $query = "INSERT INTO Users (UserEmail, UserFullName, UserPassword) VALUES (:email, :fullname, :password)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":email", $user->email);
        $stmt->bindParam(":fullname", $user->fullName);
        $stmt->bindParam(":password", password_hash($user->password, PASSWORD_BCRYPT));

        if ($stmt->execute()) {
            $user->id = $this->conn->lastInsertId();
            return true;
        }
        return false;
    }

    public function getUserByEmail($email) {
        $query = "SELECT * FROM Users WHERE UserEmail = :email LIMIT 0,1";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new User($row['UserID'], $row['UserEmail'], $row['UserFullName'], $row['UserPassword']);
        }
        return null;
    }
}
?>