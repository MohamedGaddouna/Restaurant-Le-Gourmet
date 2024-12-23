<?php
require_once '../app/models/Database.php';
class User
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function addUser($email, $password)
    {
        $stmt = $this->db->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
        $stmt->execute(['email' => $email, 'password' => $password]);
    }

    public function deleteUser($id)
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
    public function getUser($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }
    public function authentication($email, $password)
    {
        $user = $this->getUser($email);
        if ($user && $password === $user["password"]) {
            return $user;
        }
        return null;
    }
}
