<?php
class Order {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function createOrder($userId, $serviceId, $link, $quantity) {
        $service = (new Service())->getService($serviceId);
        $price = $service['price'] * $quantity;

        $sql = "INSERT INTO orders (user_id, service_id, link, quantity, price) 
                VALUES (?, ?, ?, ?, ?)";
        return $this->db->query($sql, [$userId, $serviceId, $link, $quantity, $price]);
    }

    public function getUserOrders($userId) {
        $sql = "SELECT o.*, s.name as service_name 
                FROM orders o 
                JOIN services s ON o.service_id = s.id 
                WHERE o.user_id = ? 
                ORDER BY o.created_at DESC";
        $stmt = $this->db->query($sql, [$userId]);
        return $stmt->fetchAll();
    }

    public function getOrder($id) {
        $sql = "SELECT * FROM orders WHERE id = ?";
        $stmt = $this->db->query($sql, [$id]);
        return $stmt->fetch();
    }
}