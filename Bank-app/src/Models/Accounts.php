<?php 
    namespace Models;
    require_once __DIR__.'/../../config/Database.php';
    require_once __DIR__.'/../Controllers/BankController.php';

    use Config\Database;
    use PDOException;

    class Accounts{
        private $db;

        public function __construct(Database $database) {
            $this->db =  $database->getConnection();
        }

        public function getAccountInformation($id){
            try {
                $sql = "SELECT accounts.id, fullname, name, balance, number, agency , banks.code, banks.name  FROM clients JOIN accounts ON clients.id = accounts.bank_id JOIN banks ON accounts.bank_id = banks.id WHERE clients.id = :id ";
                $stmt = $this->db->prepare($sql);
                $stmt->execute(['id' => $id]);
                return $stmt->fetch();
            } catch (PDOException $e) {
                return [$e->getMessage()];
            }
        }

        public function getCreditsInformation($id){
            
            try {
                
                if ($id) {
                    $sql = "SELECT total_limit, used_limit FROM credit_limits JOIN accounts ON accounts.id = credit_limits.account_id WHERE credit_limits.account_id = :id";
                    $stmt = $this->db->prepare($sql);
                    $stmt->execute(['id' => $id]);
                    $result = $stmt->fetch();
                    if ($result === false) {
                        return ['total_limit' => 0.0, 'used_limit' => 0.0];
                    } else {
                        return $result;
                    }
                } else {
                  return [];
                }
            } catch (PDOException $e) {
                return [$e->getMessage()];
            }
        }
    }

?>