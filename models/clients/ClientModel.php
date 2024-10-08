<?php
namespace models\clients;

use models\Database;

class ClientModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();

        try {
            $result = $this->db->query("SELECT 1 FROM `client_list` LIMIT 1");
        } catch (\PDOException $e) {
            $this->createTable();
        }
    }

    public function createTable()
    {
        $query = "CREATE TABLE IF NOT EXISTS `clients_list` (
            `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `name` VARCHAR(255) NOT NULL,
            `surname` VARCHAR(255) NOT NULL,
            `parent` VARCHAR(255) NOT NULL,
            `phone` VARCHAR(255) NOT NULL,
            `age` INT,
            `comment` TEXT,
            `branch_id` INT(11) NOT NULL,
            `status` ENUM('new', 'studies','paused', 'leave') NOT NULL,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            `visiting` TEXT
        )";
        $query_lesson_clients = "CREATE TABLE IF NOT EXISTS `lesson_clients` (
            `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `client_id` INT(11) NOT NULL,
            `lesson_id` INT(11) NOT NULL,
            FOREIGN KEY (client_id) REFERENCES clients_list(id),
            FOREIGN KEY (lesson_id) REFERENCES lesson_list(id)
        )";
        try {
            $resultClients = $this->db->exec($query);
            $resultLessonsClients = $this->db->exec($query_lesson_clients);

            if ($resultClients !== false && $resultLessonsClients !== false) {
                return true;
            } else {
                throw new \PDOException("Ошибка при создании таблиц");
            }
        } catch (\PDOException $e) {
            echo "Ошибка: " . $e->getMessage();
            return false;
        }
    }

    public function getAllClients()
    {

        try {
            $stmt = $this->db->query("SELECT * FROM clients_list");
            $сlient_list = [];
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $сlient_list[] = $row;
            }
            return $сlient_list;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function getClientsByLessonId($lesson_id)
    {
        $query = "SELECT * FROM clients_list
        JOIN lesson_clients ON clients_list.id = lesson_clients.client_id
        WHERE lesson_clients.lesson_id = :lesson_id";

        try {
            $stmt = $this->db->prepare($query);

            $stmt->execute(['lesson_id' => $lesson_id]);
            $clients_list = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $clients_list ? $clients_list : $clients_list = [];

        } catch (\PDOException $e) {

            return false;
        }
    }

    public function createClient($data)
    {

        $query = "INSERT INTO clients_list (name, surname, parent, phone, age, branch_id, status, visiting) VALUES (?,?, ?, ?, ?, ?, ?,?)";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$data['name'], $data['surname'], $data['parent'], $data['phone'], $data['age'], $data['branch_id'], $data['status'], $data['visiting']]);
            return $this->db->lastInsertId();
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function getClientById($id)
    {
        $query = "SELECT * FROM clients_list WHERE id = ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $сlient = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $сlient ? $сlient : false;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function updateClient($data)
    {
        $query = "UPDATE clients_list SET name = ?, surname = ?, parent = ?, phone = ?, age = ?, branch_id = ?, status = ?,  comment = ? WHERE id = ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$data['name'], $data['surname'], $data['parent'], $data['phone'], $data['age'], $data['branch_id'], $data['status'], $data['comment'], $data['id']]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }
    
    public function saveClient($visit,$id)
    {
        $query = "UPDATE clients_list SET visiting = ? WHERE id = ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$visit, $id]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }
    
    public function addLessonClient($client_id, $lesson_id)
    {
        $query = "INSERT INTO lesson_clients (client_id, lesson_id) VALUE (?,?)";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$client_id, $lesson_id]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }
    public function removeAllLessonClient($client_id)
    {
        $query = "DELETE FROM lesson_clients WHERE client_id = :client_id";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute(['client_id' => $client_id]);
        } catch (\PDOException $e) {
            return false;
        }
    }
    public function deleteClient($id)
    {
        $query = "DELETE FROM clients_list WHERE id = ?";

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