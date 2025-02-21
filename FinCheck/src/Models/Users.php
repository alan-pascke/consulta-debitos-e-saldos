<?php 
    namespace Models;
    require_once __DIR__.'/../../config/Database.php';

    use Config\Database;
    use PDOException;

    class User {
        private $db;
        
        public function __construct(Database $database) {
            $this->db =  $database->getConnection();
        }

        public function getAll() {
            try {
                $sql = "SELECT * FROM users";
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll();
            } catch (PDOException $e) {
                return [];
            }
        }

        public function getUserByEmail($email) {
            try {
                $sql = "SELECT * FROM users WHERE email = :email";
                $stmt = $this->db->prepare($sql);
                $stmt->execute(['id' => $email]);
                return $stmt->fetch();
            } catch (PDOException $e) {
                return [];
            }
        }
    }

?>