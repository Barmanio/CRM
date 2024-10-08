<?php
namespace models\directions;

use models\Database;

class DirectionModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();

        try {
            $result = $this->db->query("SELECT 1 FROM `directions` LIMIT 1");
        } catch (\PDOException $e) {
            $this->createTable();

        }
    }

    public function createTable()
    {
        $roleTableQuery = "CREATE TABLE IF NOT EXISTS `directions` (
            `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `title` VARCHAR(255) NOT NULL,
            `description` TEXT NOT NULL
        );
        ";

        try {
            $this->db->exec($roleTableQuery);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function getAllDirections()
    {
        try {
            $stmt = $this->db->query("SELECT * FROM directions");
            $directions = [];
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $directions[] = $row;
            }
            return $directions;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function getDirectionById($id)
    {
        $query = "SELECT * FROM directions WHERE id = ?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $direction = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $direction ? $direction : false;
        } catch (\PDOException $e) {
            return false;
        }

    }

    public function getDirectionNameById($direction_id)
    {
        $query = "SELECT * FROM directions WHERE id = ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$direction_id]);
            $direction = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $direction ? $direction['title'] : '';
        } catch (\PDOException $e) {
            return false;
        }
    }
    public function createDirection($title, $description)
    {

        $query = "INSERT INTO directions (title,description) VALUE (?,?)";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$title, $description]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }


    public function updateDirection($id, $title, $description)
    {
        $query = "UPDATE directions SET title = ?, description = ? WHERE id = ?";

        try {

            $stmt = $this->db->prepare($query);
            $stmt->execute([$title, $description,  $id]);

            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function deleteDirection($id)
    {
        $query = "DELETE FROM directions WHERE id = ?";

        try {

            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);

            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }
}