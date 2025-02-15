<?php 
    namespace Models;
    require_once __DIR__.'/../../config/Database.php';

    use Config\Database;
    use PDOException;

    class Clients{
        private $db;
        public function __construct(Database $database) {
            $this->db =  $database->getConnection();
        }

        public function getAll(){
            try{
                $sql = "SELECT * FROM clients";
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll();
                
            }catch(PDOException $e){
                return [];
            }
        }

        public function getClient($id){
            try{
                $sql = "SELECT * FROM clients WHERE id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->execute(['id' => $id]);
                return $stmt->fetch();
                
            }catch(PDOException $e){
                return [];
            }
        }

        public function checkIfClientExists($cpf, $password){
            try{
                $sql = "SELECT * FROM clients WHERE cpf = :cpf AND password = :password";
                $stmt = $this->db->prepare($sql);
                $stmt->execute(['cpf' => $cpf, 'password' => $password]);
                $client = $stmt->fetch();
                return $client;
            
            }catch(PDOException $e){
                return [$e->getMessage()];
            }
        }
    }

?>