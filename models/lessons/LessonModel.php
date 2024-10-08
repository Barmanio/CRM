<?php
namespace models\lessons;

use models\Database;
use models\branches\BranchModel;
use models\directions\DirectionModel;
class LessonModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();

        try {
            $result = $this->db->query("SELECT 1 FROM `lesson_list` LIMIT 1");
        } catch (\PDOException $e) {
            $this->createTable();
        }
    }

    public function createTable()
    {
        $query_lessons = "CREATE TABLE IF NOT EXISTS `lesson_list` (
            `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `direction_id` INT(11),
            `branch_id` INT(11),
            `day_week` VARCHAR(255) NOT NULL,
            `time` TIME NOT NULL
        )";

        $query_lesson_branches = "CREATE TABLE IF NOT EXISTS `lesson_branches` (
            `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `branch_id` INT(11) NOT NULL,
            `lesson_id` INT(11) NOT NULL,
            FOREIGN KEY (branch_id) REFERENCES branches(id),
            FOREIGN KEY (lesson_id) REFERENCES lesson_list(id)
        )";
        try {
            $resultLessons = $this->db->exec($query_lessons);
            $resultLessonsBranches = $this->db->exec($query_lesson_branches);

            if ($resultLessons !== false && $resultLessonsBranches !== false) {
                return true;
            } else {
                throw new \PDOException("Ошибка при создании таблиц");
            }
        } catch (\PDOException $e) {
            echo "Ошибка: " . $e->getMessage();
            return false;
        }
    }

    public function getLessonById($id)
    {
        $query = "SELECT * FROM lesson_list WHERE id = ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $lesson = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $lesson ? $lesson : false;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function getLessonByBranchId($branch_id)
    {
        $query = "SELECT * FROM lesson_list
        JOIN lesson_branches ON lesson_list.id = lesson_branches.lesson_id
        WHERE lesson_list.branch_id = :branch_id";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute(['branch_id' => $branch_id]);
            $lessons_list = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $lessons_list ? $lessons_list : $lessons_list = [];

        } catch (\PDOException $e) {
            return false;
        }
    }


    public function removeAllLessonBranch($branch_id)
    {
        $query = "DELETE FROM lesson_branches WHERE branch_id = :branch_id";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute(['branch_id' => $branch_id]);
        } catch (\PDOException $e) {
            return false;
        }
    }


    public function addLesson($data)
    {
        $query = "INSERT INTO lesson_list (direction_id,branch_id,day_week,time) VALUE (?,?,?,?)";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$data['direction_id'], $data['branch_id'], $data['day_week'], $data['time']]);
            return $this->db->lastInsertId();
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function addLessonBranch($branch_id, $lesson_id)
    {
        $query = "INSERT INTO lesson_branches (branch_id, lesson_id) VALUE (?,?)";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$branch_id, $lesson_id]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function getLessonNameById($lesson_id)
    {
        $query = "SELECT * FROM lesson_list WHERE id = ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$lesson_id]);
            $lesson = $stmt->fetch(\PDO::FETCH_ASSOC);
            $branchModel = new BranchModel();
            $branch = $branchModel->getBranchNameById($lesson['branch_id']);
            $directionModel = new DirectionModel();
            $direction = $directionModel-> getDirectionNameById($lesson['direction_id']);
            $tim = substr( $lesson['time'], 0, 5);
            return $lesson ? $branch . ' | ' . $direction .' | ' . $lesson['day_week']. ' | ' . $tim : '';
        } catch (\PDOException $e) {
            return false;
        }
    }
    public function deleteLesson($id)
    {
        $query = "DELETE FROM lesson_list WHERE id = ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }
    public function updateLesson($data)
    {
        $query = "UPDATE lesson_list SET direction_id = ?, branch_id = ?, day_week = ?, time = ? WHERE id = ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$data['direction_id'], $data['branch_id'], $data['day_week'], $data['time'], $data['id']]);

            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }
}
?>