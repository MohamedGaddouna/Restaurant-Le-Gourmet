<?php
require_once '../app/models/Database.php';
class Item
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function addItem($name, $price)
    {
        $stmt = $this->db->prepare("INSERT INTO items (name, price) VALUES (:name, :price)");
        $stmt->execute(['name' => $name, 'price' => $price]);
    }

    public function deleteItem($id)
    {
        $stmt = $this->db->prepare("DELETE FROM items WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}
