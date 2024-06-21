<?php
require_once '../autoload.php';
require_once '../repositories/UserRepository.php';

class UserController {
    private $userRepository;

    public function __construct() {
        $this->userRepository = new UserRepository();
    }

    public function register($email, $fullName, $password) {
        $user = new User(null, $email, $fullName, $password);
        return $this->userRepository->createUser($user);
    }

    public function login($email, $password) {
        $user = $this->userRepository->getUserByEmail($email);
        if ($user && password_verify($password, $user->password)) {
            $_SESSION['user'] = $user;
            return true;
        }
        return false;
    }
}
?>