<?php 
namespace Config;
require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use PDO;
use PDOException;

class Database {
        private $pdo;

        public function __construct() {
            $dotenv = Dotenv::createImmutable(__DIR__.'/../');
            $dotenv->load();

            try {
                $this->pdo = new PDO(
                    "pgsql:host=".$_ENV['DB_HOST'].";dbname=".$_ENV['DB_NAME'].";port=".$_ENV['DB_PORT'], 
                    $_ENV['DB_USER'], 
                    $_ENV['DB_PASS']);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erro na conexão com o banco de dados: " . $e->getMessage());
            }
        }

        public function getConnection() {
            return $this->pdo;
        }
    }
