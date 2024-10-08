<?php
namespace models\branches;

use models\Database;

class BranchModel
{
    private $db;
    private $userID;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();

        try {
            $result = $this->db->query("SELECT 1 FROM `branches` LIMIT 1");
        } catch (\PDOException $e) {
            $this->createTable();
        }
    }

    public function createTable()
    {
        $query = "CREATE TABLE IF NOT EXISTS `branches` (
            `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `title` VARCHAR(255) NOT NULL,
            `address` TEXT NOT NULL,
            `description` TEXT
        )";

        try {
            $this->db->exec($query);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function getAllBranches()
    {
        try {
            $stmt = $this->db->query("SELECT * FROM branches");
            $branches = [];
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $branches[] = $row;
            }
            return $branches ? $branches : [];
        } catch (\PDOException $e) {
            return false;
        }
    }


    public function createBranch($title, $address)
    {
        $query = "INSERT INTO branches (title, address) VALUES (?, ?)";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$title, $address]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function getBranchById($id)
    {
        $query = "SELECT * FROM branches WHERE id = ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $branch = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $branch ? $branch : [];
        } catch (\PDOException $e) {
            return [];
        }
    }
    public function getBranchNameById($branch_id)
    {
        $query = "SELECT * FROM branches WHERE id = ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$branch_id]);
            $branch = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $branch ? $branch['title']  : '';
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function updateBranch($id, $title, $address, $description)
    {
        $query = "UPDATE branches SET title = ?, address = ?, description = ? WHERE id = ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$title, $address, $description, $id]);

            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function deleteBranch($id)
    {
        $query = "DELETE FROM branches WHERE id = ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }
}
?>