<?php
namespace models\pages;

use models\Database;
use models\roles\Role;

class PageModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();

        try {
            $result = $this->db->query("SELECT 1 FROM `pages` LIMIT 1");
        } catch (\PDOException $e) {
            $this->createTable();

        }
    }

    public function createTable()
    {
        $roleTableQuery = "CREATE TABLE IF NOT EXISTS `pages` (
            `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `title` VARCHAR(255) NOT NULL,
            `slug` VARCHAR(255) NOT NULL,
            `role` VARCHAR(255) NOT NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ";

        try {
            $this->db->exec($roleTableQuery);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function insertPages(){
        $insertPagesQuery = "INSERT INTO `pages` (`id`, `title`,`slug`, `role`,`created_at`, `updated_at`) VALUES
         (1, 'Home', '/', '1,2,3,4,5', '2023-09-03 10:22:01', '2023-09-03 12:16:30'),
        (2, 'Users', 'users', '1,2,5', '2023-09-03 10:25:20', '2023-09-03 11:31:04'),
        (3, 'User create', 'users/create', '3,4,5', '2023-09-03 12:08:29', '2023-09-03 12:09:38'),
        (4, 'User edit', 'users/edit', '2,5', '2023-09-03 11:33:37', '2023-09-03 11:59:39'),
        (5, 'Users store', 'users/store', '3,4,5', '2023-09-03 12:11:08', '2023-09-03 12:11:08'),
        (6, 'Users update', 'users/update', '5', '2023-09-03 12:11:45', '2023-09-03 12:11:45'),
        (7, 'Users delete', 'users/delete', '5', '2023-09-03 12:18:32', '2023-09-03 12:18:32'),
        (8, 'Roles', 'roles', '2,3,4,5', '2023-09-03 12:12:24', '2023-09-03 12:12:24'),
        (9, 'Roles create', 'roles/create', '3,4,5', '2023-09-03 12:12:48', '2023-09-03 12:12:48'),
        (10, 'Roles edit', 'roles/edit', '3,4,5', '2023-09-03 12:13:50', '2023-09-03 12:13:50'),
        (11, 'Roles store', 'roles/store', '3,4,5', '2023-09-03 12:13:14', '2023-09-03 12:13:14'),
        (12, 'Roles update', 'roles/update', '5', '2023-09-03 12:14:16', '2023-09-03 12:14:16'),
        (13, 'Roles delete', 'roles/delete', '5', '2023-09-03 13:57:27', '2023-09-03 13:57:27'),
        (14, 'Pages', 'pages', '5', '2023-09-03 10:55:54', '2023-09-03 10:55:54'),
        (15, 'Pages create', 'pages/create', '5', '2023-09-03 11:30:12', '2023-09-03 11:30:27'),
        (16, 'Pages edit', 'pages/edit', '5', '2023-09-03 11:30:53', '2023-09-03 11:30:53'),
        (17, 'Pages store', 'pages/store', '5', '2023-09-03 13:56:39', '2023-09-03 13:56:39'),
        (18, 'Pages update', 'pages/update', '5', '2023-09-03 12:16:20', '2023-09-03 12:16:20'),
        (19, 'Pages delete', 'pages/delete', '5', '2023-09-03 11:31:05', '2023-09-03 11:31:05'),
        (20, 'Todo category', 'todo/category', '3,4,5', '2023-09-03 20:15:41', '2023-09-03 20:15:41'),
        (21, 'Todo category create', 'todo/category/create', '3,4,5', '2023-09-03 20:13:55', '2023-09-03 20:13:55'),
        (22, 'Todo category edit', 'todo/category/edit', '3,4,5', '2023-09-03 20:14:27', '2023-09-03 20:14:27'),
        (23, 'Todo category store', 'todo/category/store', '3,4,5', '2023-09-03 20:16:46', '2023-09-03 20:16:46'),
        (24, 'Todo category update', 'todo/category/update', '3,4,5', '2023-09-03 20:17:45', '2023-09-03 20:17:45'),
        (25, 'Todo category delete', 'todo/category/delete', '3,4,5', '2023-09-03 20:17:09', '2023-09-03 20:17:09'),
        (26, 'Tasks', 'todo/tasks', '3,4,5', '2023-09-03 15:51:40', '2023-09-03 15:51:40'),
        (27, 'Task create', 'todo/tasks/create', '3,4,5', '2023-09-03 15:53:46', '2023-09-03 15:54:38'),
        (28, 'Task edit', 'todo/tasks/edit', '3,4,5', '2023-09-03 17:54:44', '2023-09-03 17:54:44'),
        (29, 'Task store', 'todo/tasks/store', '3,4,5', '2023-09-03 18:31:50', '2023-09-03 18:31:50'),
        (30, 'Task update', 'todo/tasks/update', '3,4,5', '2023-09-03 17:53:55', '2023-09-03 17:53:55'),
        (31, 'Task delete', 'todo/taska/delete', '3,4,5', '2023-09-03 17:54:19', '2023-09-03 17:54:19'),
        (32, 'Tasks completed', 'todo/tasks/completed', '3,4,5', '2023-09-03 20:50:23', '2023-09-03 20:50:23'),
        (33, 'Expired tasks', 'todo/tasks/expired', '3,4,5', '2023-09-03 21:23:19', '2023-09-03 21:23:19'),
        (34, 'Todo tasks task', 'todo/tasks/task', '2,3,4,5', '2023-09-03 13:59:59', '2023-09-03 14:01:02'),
        (35, 'Todo tasks by tag', 'todo/tasks/by-tag', '2,3,4,5', '2023-09-03 14:00:48', '2023-09-03 14:00:48'),
        (36, 'Branch', 'branches', '2,3,4,5', '2023-09-03 12:12:25', '2023-09-03 12:12:26'),
        (37, 'Branch create', 'branches/create', '3,4,5', '2023-09-03 12:12:49', '2023-09-03 12:12:50'),
        (38, 'Branch edit', 'branches/edit', '3,4,5', '2023-09-03 12:13:51', '2023-09-03 12:13:52'),
        (39, 'Branch store', 'branches/store', '3,4,5', '2023-09-03 12:13:15', '2023-09-03 12:13:16'),
        (40, 'Branch update', 'branches/update', '5', '2023-09-03 12:14:17', '2023-09-03 12:14:18'),
        (41, 'Branch delete', 'branches/delete', '5', '2023-09-03 13:57:28', '2023-09-03 13:57:29'),
        (42, 'Clients', 'clients', '2,3,4,5', '2023-09-04 12:12:25', '2023-09-03 12:12:26'),
        (43, 'Clients create', 'clients/create', '3,4,5', '2023-09-04 12:12:49', '2023-09-03 12:12:50'),
        (44, 'Clients edit', 'clients/edit', '3,4,5', '2023-09-04 12:13:51', '2023-09-03 12:13:52'),
        (45, 'Clients store', 'clients/store', '3,4,5', '2023-09-04 12:13:15', '2023-09-03 12:13:16'),
        (46, 'Clients update', 'clients/update', '5', '2023-09-04 12:14:17', '2023-09-03 12:14:18'),
        (47, 'Clients delete', 'clients/delete', '5', '2023-09-04 13:57:28', '2023-09-03 13:57:29'),
        (48, 'Lessons', 'lessons', '2,3,4,5', '2023-09-04 12:12:25', '2023-09-03 12:12:26'),
        (49, 'Lessons create', 'lessons/create', '3,4,5', '2023-09-04 12:12:49', '2023-09-03 12:12:50'),
        (50, 'Lessons edit', 'lessons/edit', '3,4,5', '2023-09-04 12:13:51', '2023-09-03 12:13:52'),
        (51, 'Lessons store', 'lessons/store', '3,4,5', '2023-09-04 12:13:15', '2023-09-03 12:13:16'),
        (52, 'Lessons update', 'lessons/update', '5', '2023-09-04 12:14:17', '2023-09-03 12:14:18'),
        (53, 'Lessons delete', 'lessons/delete', '5', '2023-09-04 13:57:28', '2023-09-03 13:57:29'),
        (54, 'Lessons save', 'lessons/save', '3,4,5', '2023-09-08 13:57:28', '2023-09-08 13:57:29'),
        (55, 'Lessons by branch', 'branches/lessonbybranch', '3,4,5', '2023-09-07 13:57:28', '2023-09-03 13:57:29'),
        (56, 'Directions', 'directions', '2,3,4,5', '2023-09-05 12:12:25', '2023-09-05 12:12:26'),
        (57, 'Directions create', 'directions/create', '3,4,5', '2023-09-05 12:12:49', '2023-09-05 12:12:50'),
        (58, 'Directions edit', 'directions/edit', '3,4,5', '2023-09-05 12:13:51', '2023-09-05 12:13:52'),
        (59, 'Directions store', 'directions/store', '3,4,5', '2023-09-05 12:13:15', '2023-09-05 12:13:16'),
        (60, 'Directions update', 'directions/update', '5', '2023-09-05 12:14:17', '2023-09-05 12:14:18'),
        (61, 'Directions delete', 'directions/delete', '5', '2023-09-05 13:57:28', '2023-09-05 13:57:29');
        ";

        try{
            $this->db->exec($insertPagesQuery);
            return true;
        } catch (\PDOException $e){
            return false;
        }

    }

    public function getAllPages()
    {
        try {
            $stmt = $this->db->query("SELECT * FROM pages");
            $pages = [];
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $pages[] = $row;
            }
            return $pages;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function getPageById($id)
    {
        $query = "SELECT * FROM pages WHERE id = ?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $page = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $page ? $page : false;
        } catch (\PDOException $e) {
            return false;
        }

    }
    public function findBySlug($slug)
    {
        $query = "SELECT * FROM pages WHERE slug = ?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$slug]);
            $page = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $page ? $page : false;
        } catch (\PDOException $e) {
            return false;
        }

    }
    public function createPage($title, $slug, $roles)
    {

        $query = "INSERT INTO pages (title,slug,role) VALUE (?,?,?)";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$title, $slug, $roles]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }


    public function updatePage($id, $title, $slug,$roles)
    {
        $query = "UPDATE pages SET title = ?, slug = ?, role = ? WHERE id = ?";

        try {

            $stmt = $this->db->prepare($query);
            $stmt->execute([$title, $slug, $roles, $id]);

            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function deletePage($id)
    {
        $query = "DELETE FROM pages WHERE id = ?";

        try {

            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);

            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }
}