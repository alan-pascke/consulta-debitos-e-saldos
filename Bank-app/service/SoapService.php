<?php 
    
    require_once __DIR__.'/../config/Database.php';
    
    use Config\Database;
    use PHP2WSDL\PHPClass2WSDL;

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    
    class BankService {
    private $db;

    public function __construct(Database $database) {
        $this->db =  $database->getConnection();
    }
    
    /**
     * Obtém as informações da conta de um cliente com base no CPF.
     *
     * @param string $cpf O CPF do cliente.
     * @return array Retorna um array com as informações da conta ou uma mensagem de erro.
     * @soap
     */
    public function getAccountInformation(string $cpf) {
        try {
            $client = $this->db->query("SELECT id FROM clients WHERE cpf ='$cpf'");
            $clientId = $client->fetch()['id'];

            if (!$clientId) {
                return ['error' => 'Usuário não encontrado'];
            }

            $sql = "SELECT banks.name, accounts.balance, credit_limits.total_limit, credit_limits.used_limit 
                    FROM accounts LEFT JOIN banks ON banks.id = accounts.bank_id 
                    LEFT JOIN credit_limits ON credit_limits.account_id = accounts.id 
                    WHERE accounts.client_id = '$clientId'";

            $stmt = $this->db->prepare($sql);
            // $stmt->bindParam(':client_id', $clientId);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return [$e->getMessage()];
        }
    }
    
}

    $serviceUrl = "http://localhost:8080/service/SoapService.php";
    
    if (!file_exists('service.wsdl')) {
        $database = new Database();
        $service = new BankService($database);
        $wsdlGenerator = new PHPClass2WSDL(BankService::class, $serviceUrl);
        $wsdlGenerator->generateWSDL(true);
        file_put_contents('service.wsdl', $wsdlGenerator->dump());
    }
    if (isset($_REQUEST['wsdl'])) {
        $wsdl = file_get_contents('service.wsdl');
        header('Content-Type: text/xml');
        echo $wsdl;
    } else {
        $database = new Database();
        $service = new BankService($database);
        // $server = new SoapServer(null, $options);
        $server = new SoapServer('service.wsdl');
        $server->setObject($service);
        $server->handle();  
    }
?>

