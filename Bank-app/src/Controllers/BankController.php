<?php 

    namespace Controllers;
    require_once __DIR__.'/../../config/Database.php';
    require_once __DIR__.'/../Models/Banks.php';

    use Config\Database;
    use Models\Banks;

    class BankController{
        private $bankModel;

        public function __construct(){
            $db = new Database();
            $this->bankModel = new Banks($db);
        }

        public function getBank($code){
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                return $this->bankModel->getBank($code);
            } else {
                return 'Erro ao buscar banco';
            }
        }

        public function getAllBanks(){
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                return $this->bankModel->getAll();
            } else {
                return 'Erro ao buscar bancos';
            }
        }

        // public function addBank(){
        //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //         $name = $_POST['name'];
        //         $balace = $_POST['balace'];
        //         $credit = $_POST['credit'];
        //         $debt = $_POST['debt'];
        //         if (!empty($name) && !empty($balace) && !empty($credit) && !empty($debt)) {
        //             $result = $this->bankModel->addBank($name, $balace, $credit, $debt);
                
        //             if ($result) {
        //                 // redirecionar para a pagina principal
        //             } else {
        //                 echo 'Erro ao adicionar banco';
        //             }
        //         } else {
        //             echo 'Preencha todos os campos';
        //         }
        //     }
        // }
    }