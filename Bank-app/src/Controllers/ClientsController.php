<?php 
    namespace Controllers;

    require_once __DIR__.'/../../config/Database.php';
    require_once __DIR__.'/../Models/Clients.php';
    require_once __DIR__.'/../Models/Banks.php';

    use Config\Database;
    use Models\Clients;
    use Models\Banks;
    
    
    class ClientsController{
        private $accountModel;
        private $bank;

        public function __construct(){
            $db = new Database();
            $this->accountModel = new Clients($db);
            $this->bank = new Banks($db);
        }

        public function getAccounts(){
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                return $this->accountModel->getAll();
            } else {
                return 'Erro ao buscar contas';
            }
        }

        public function login(){
            session_start();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $cpf = $_POST['cpf'];
                $password = $_POST['password'];

                if (empty($cpf) || empty($password)) {
                    $_SESSION['error'] = "Por favor, preencha todos os campos.";
                    header('Location: /src/Views/banco/login.php/?code='.$_GET['code']);
                    exit();
                }

                $bank_code = $_GET['code'];
                $bank_id = $this->bank->getBank($bank_code)['id'];
                $client = $this->accountModel->checkIfClientExists($cpf, $password, $bank_id);

                if ($client) {
                    $_SESSION['client_id'] = $client['client_id'];
                    header('Location: /src/Views/banco/home.php');
                    exit();
                } elseif (!password_verify($password, $client['password'])) {
                    $_SESSION['error'] = "Senha incorreta.";
                    header('Location: /src/Views/banco/login.php/?code='.$_GET['code']);
                    exit();
                } elseif ($client == false ) {
                    $_SESSION['error'] = "Usuário não encontrado.";
                    header('Location: /src/Views/banco/login.php/?code='.$_GET['code']);
                    exit();
                }
            }
        }

        public function logout(){
            session_start();
            session_destroy();
            header('Location: /src/Views/banco/login.php/?code='.$_GET['code']);
            exit();
        }
    
    }
?>