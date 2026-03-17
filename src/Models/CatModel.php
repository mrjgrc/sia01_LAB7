<?php
namespace App\Models;
use PDO;

class CatModel {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM cats");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM cats WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($name, $owner, $birth, $gender) {
        $stmt = $this->db->prepare("INSERT INTO cats (name, owner, birth, gender) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$name, $owner, $birth, $gender]);
    }

    public function update($id, $name, $owner, $birth, $gender) {
        $stmt = $this->db->prepare("UPDATE cats SET name = ?, owner = ?, birth = ?, gender = ? WHERE id = ?");
        return $stmt->execute([$name, $owner, $birth, $gender, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM cats WHERE id = ?");
        return $stmt->execute([$id]);
    }
}