<?php 
    namespace Models;
    require_once __DIR__.'/../../config/Database.php';

    use Config\Database;
    use PDOException;



    class Bank{
        private $db;

        public function __construct(Database $database){
            $this->db =  $database->getConnection();
        }

        public function getAll(){
            try{
                $sql = "SELECT * FROM banks";
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll();
                
            }catch(PDOException $e){
                return [];
            }
        }

        public function addBank($name, $balace, $credit, $debt){
            try{
                $sql = "INSERT INTO banks (name, balance, credit, debt) VALUES (:name, :balance, :credit, :debt)";
                $stmt = $this->db->prepare($sql);;
                $stmt->execute( params:[
                    'name' => $name,
                    'balance' => $balace,
                    'credit' => $credit,
                    'debt' => $debt
                ]);
                return "Banco adicionado com sucesso!";
            }catch(PDOException $e){
                echo "Erro ao adicionar banco: " . $e->getMessage();
            }
        }
    }