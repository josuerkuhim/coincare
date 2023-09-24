<?php

class UserModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createUser($username, $password, $role)
    {
        $query = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->execute([$username, $hashedPassword, $role]);
    }

    public function findByUsername($username)
    {
        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // CONTINUAR

    public static function validateCredentials($username, $password)
    {
        return $username === 'usuario' && $password === 'senha';
    }
}
