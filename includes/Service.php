<?php
class Service {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAllServices() {
        $sql = "SELECT s.*, c.name as category_name 
                FROM services s 
                JOIN categories c ON s.category_id = c.id 
                WHERE s.status = 1";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function getServicesByCategory($categoryId) {
        $sql = "SELECT * FROM services WHERE category_id = ? AND status = 1";
        $stmt = $this->db->query($sql, [$categoryId]);
        return $stmt->fetchAll();
    }

    public function getService($id) {
        $sql = "SELECT * FROM services WHERE id = ?";
        $stmt = $this->db->query($sql, [$id]);
        return $stmt->fetch();
    }

    public function getAllCategories() {
        $sql = "SELECT * FROM categories WHERE status = 1 ORDER BY sort_order";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }
}