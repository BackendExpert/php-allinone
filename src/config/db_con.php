<?php 
include 'app.php';

class Database
{
    private $host;
    private $username;
    private $password;
    private $database;
    private $charset;
    private $pdo;

    public function __construct($config)
    {
        $this->host = $config['host'];
        $this->username = $config['username'];
        $this->password = $config['password'];
        $this->database = $config['database'];
        $this->charset = $config['charset'];

        $this->connect();
    }

    private function connect()
    {
        $dsn = "mysql:host={$this->host};dbname={$this->database};charset={$this->charset}";

        try {
            $this->pdo = new PDO($dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->pdo;
    }
}