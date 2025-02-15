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

        public function checkIfClientExists($cpf, $password, $bank_id){
            try{
                $sql = "SELECT clients.id as client_id , * FROM clients  JOIN accounts ON clients.id = accounts.bank_id WHERE accounts.bank_id=:bank_id AND cpf=:cpf AND password =:password";
                $stmt = $this->db->prepare($sql);
                $stmt->execute(['cpf' => $cpf, 'password' => $password, 'bank_id' => $bank_id]);
                return $stmt->fetch();
            
            }catch(PDOException $e){
                return [$e->getMessage()];
            }
        }
    }

?>