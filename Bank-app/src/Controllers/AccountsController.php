<?php 
    namespace Controllers;
    require_once __DIR__.'/../../config/Database.php';
    require_once __DIR__.'/../Models/Accounts.php';

    use Config\Database;
    use Models\Accounts;

    class AccountsController {
        private $bankModel;

        public function __construct() {
            $db = new Database();
            $this->bankModel = new Accounts($db);
        }

        public function getAccountInformation($id) {
            try {
                return $this->bankModel->getAccountInformation($id);
            } catch (\Throwable $e) {
                return [$e->getMessage()];
            }
        }

        public function getCreditsInformation($id) {
            try {
                return $this->bankModel->getCreditsInformation($id);
            } catch (\Throwable $e) {
                return [$e->getMessage()];
            }
        }
    }

?>