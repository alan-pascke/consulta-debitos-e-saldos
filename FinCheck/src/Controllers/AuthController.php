<?php 
    namespace Controllers;
    require_once __DIR__.'/../../config/Database.php';
    require_once __DIR__.'/../Models/User.php';

    use Config\Database;
    use Models\User;

    class AuthController {
        private $authModel;
        public function __construct() {
            $db = new Database();
            $this->authModel = new User($db);
        }

        public function login() {
            session_start();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $email = $_POST['email'];
                $password = $_POST['password'];

                if (empty($email) || empty($password)) {
                    $_SESSION['error'] = "Por favor, preencha todos os campos.";
                    header('Location: /src/Views/auth/login.php');
                    exit();
                }

                $user = $this->authModel->getUserByEmail($email);

                if ($user) {
                    if (password_verify($password, $user['password'])) {
                        $_SESSION['user_id'] = $user['id'];
                        header('Location: /src/Views/auth/login.php');
                        exit();
                    } else {
                        $_SESSION['error'] = "Senha incorreta.";
                        header('Location: /src/Views/auth/login.php');
                        exit();
                    }
                } elseif ($user == false) {
                    $_SESSION['error'] = "Usuário não encontrado.";
                    header('Location: /src/Views/auth/login.php');
                    exit();
                }
            }

            
        }
        public function logout() {
            session_start();
            session_destroy();
            header('Location: /src/Views/auth/login.php');
            exit();
        }
    }

?>