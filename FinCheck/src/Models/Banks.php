<?php 
    namespace Models;
    require_once __DIR__.'/../../config/Database.php';

    use Config\Database;
    use PDOException;
    use SoapClient;

    class Banks{
        private $db;

        public function __construct(Database $database){
            $this->db =  $database->getConnection();
        }

        public function getAllBanksByCPF(){
            if($_SERVER['REQUEST_METHOD'] === 'GET'){
                $cpf = $_GET['cpf'];
                $client = new SoapClient(null, ["uri" => "http://localhost/Bank-app/service/SoapService.php"]);
                return $client->getAccountInformation($cpf);
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