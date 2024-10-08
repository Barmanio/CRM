<?php
namespace models\users;

use models\Database;

class User{
    private $db;

    public function __construct(){
        $this->db = Database::getInstance()->getConnection();

        try{
            $result = $this->db->query("SELECT 1 FROM `users` LIMIT 1");
        } catch(\PDOException $e){
            $this->createTable();
        }
    }

    private function rolesExist()
    {
        $query = "SELECT COUNT(*) FROM `roles`";
        $stmt = $this->db->query($query);
        return $stmt->fetchColumn() > 0;
    }

    private function adminUserExists()
    {
        $query = "SELECT COUNT(*) FROM `users` WHERE `username` = 'Admin' AND `is_admin` = 1";
        $stmt = $this->db->query($query);
        return $stmt->fetchColumn() > 0;
    }

    public function createTable()
    {
        $roleTableQuery = "CREATE TABLE IF NOT EXISTS `roles` (
            `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `role_name` VARCHAR(255) NOT NULL,
            `role_description` TEXT
        )";
        $userTableQuery = "CREATE TABLE IF NOT EXISTS `users` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `username` VARCHAR(255) NOT NULL,
            `email` VARCHAR(255) NOT NULL,
            `email_verification` TINYINT(1) NOT NULL DEFAULT 0,
            `password` VARCHAR(255) NOT NULL,
            `is_admin` TINYINT(1) NOT NULL DEFAULT 0,
            `role` INT(11) NOT NULL DEFAULT 0,
            `is_active` TINYINT(1) NOT NULL DEFAULT 1,
            `last_login` TIMESTAMP NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            FOREIGN KEY (`role`) REFERENCES `roles`(`id`)
          )";
        try {
            $this->db->exec($roleTableQuery);
            $this->db->exec($userTableQuery);

            // Вставка записей в таблицу roles
            if (!$this->rolesExist()) {
                $insertRolesQuery = "INSERT INTO `roles` (`role_name`, `role_description`) VALUES
                ('Subscriber', 'Может только читать статьи и оставлять комментарии, но не имеет права создавать свой контент или управлять сайтом.'),
                ('Editor', 'Доступ к управлению и публикации статей, страниц и других контентных материалов на сайте. Редактор также может управлять комментариями и разрешать или запрещать их публикацию.'),
                ('Author', 'Может создавать и публиковать собственные статьи, но не имеет возможности управлять контентом других пользователей.'),
                ('Contributor', 'Может создавать свои собственные статьи, но они не могут быть опубликованы до одобрения администратором или редактором.'),
                ('Administrator', 'Полный доступ ко всем функциям сайта, включая управление пользователями, плагинами а также создание и публикация статей.');";
                $this->db->exec($insertRolesQuery);
            }

            // Вставка записи в таблицу users
            if (!$this->adminUserExists()) {
                $insertAdminQuery = "INSERT INTO `users` (`username`, `email`, `password`, `is_admin`, `role`) VALUES
                ('Admin', 'admin@gmail.com', '\$2y\$10\$dySccJEuCWDzywOgSoSU.eafBWHBXWp0/Nd7gohVz1z6mw1QzbEjW', 1, (SELECT `id` FROM `roles` WHERE `role_name` = 'Administrator'));";
                $this->db->exec($insertAdminQuery);
            }
            return true;
        } catch(\PDOException $e){
            return false;
        }
    }

    public function readAll(){
        try{
            $stmt = $this->db->query("SELECT * FROM users");

            $users = [];
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $users[] = $row;
            }
            return $users;
        } catch(\PDOException $e){
            return false;
        }
    }

    public function create($data)
    {
        $username = $data['username'];
        $email = $data['email'];
        $password = $data['password'];
        $role = $data['role'];

        $created_at = date('Y-m-d H:i:s');

        $query = "INSERT INTO users (username, email, password, role, created_at) VALUES (?, ?, ?, ?, ?)";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$username, $email, password_hash($password, PASSWORD_DEFAULT), $role, $created_at]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function delete($id){
        $query ="DELETE FROM users WHERE id = ?";
        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return true;
        }catch(\PDOException $e){
            return false;
        }
    }


    public function read($id)
    {
        $query = "SELECT * FROM users WHERE id = ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $res = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $res;
        } catch (\PDOException $e) {
            return false;
        }
    }
    public function update($id, $data)
    {
        $username = $data['username'];
        $admin = !empty($data['admin']) && $data['admin'] !== 0 ? 1 : 0;
        $email = $data['email'];
        $role = $data['role'];
        $is_active = isset($data['is_active']) ? 1 : 0;

        $query = "UPDATE users SET username = ?, email = ?, is_admin = ?, role = ?, is_active = ? WHERE id = ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$username, $email, $admin, $role, $is_active, $id]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }
}