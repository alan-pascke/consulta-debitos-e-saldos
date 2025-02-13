<?php 
    namespace Models;
    require_once __DIR__.'/../../config/Database.php';

    use Config\Database;
    use PDOException;

    class Bank {
        private $db;

        public function __construct(Database $database) {
            $this->db =  $database->getConnection();
        }

        public function getBank($code){
            try{
                $sql = "SELECT * FROM banks WHERE code = :code";
                $stmt = $this->db->prepare($sql);
                $stmt->execute(['code' => $code]);
                return $stmt->fetch();
                
            }catch(PDOException $e){
                return [$e->getMessage()];
            }
        }
    }

?>