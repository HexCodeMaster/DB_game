<?php
//
//namespace Mastermind;
//
//use PDO;
//use PDOException;
//
//class db
//{
//    private $pdo;
//    private $stmt;
//    private $host = 'localhost';
//    private $dbname = 'mastermind';
//    private $password = '';
//    private $user = 'root';
//
//    public function __construct(
//        $host = 'localhost',
//        $user = 'root',
//        $password = '',
//        $dbname = 'mastermind'
//    ) {
//        $this->user = $user;
//        $this->password = $password;
//        $this->dbname = $dbname;
//        $this->host = $host;
//        $dsn = "mysql:host={$this->host};dbname={$this->dbname}";
//        $options = array(
//            PDO::ATTR_PERSISTENT => true,
//            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//        );
//
//        try {
//            $this->pdo = new PDO($dsn, $this->user, $this->password, $options);
//        } catch (PDOException $e) {
//            throw new Exception('Connection failed: ' . $e->getMessage());
//        }
//    }
//
//    public function query($sql, $params = [])
//    {
//        $this->stmt = $this->pdo->prepare($sql);
//    }
//
//    public function bind($param, $value, $type = null)
//    {
//        if (is_null($type)) {
//            $type = match (true) {
//                is_int($value) => PDO::PARAM_INT,
//                is_bool($value) => PDO::PARAM_BOOL,
//                is_null($value) => PDO::PARAM_NULL,
//                default => PDO::PARAM_STR,
//            };
//        }
//
//        $this->stmt->bindValue($param, $value, $type);
//    }
//
//    public function execute()
//    {
//        return $this->stmt->execute();
//    }
//
//    public function resultSet()
//    {
//        $this->execute();
//        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
//    }
//
//    public function single()
//    {
//        $this->execute();
//        return $this->stmt->fetch(PDO::FETCH_OBJ);
//    }
//
//    public function rowCount()
//    {
//        return $this->stmt->rowCount();
//    }
//
//    public function closeStatement()
//    {
//        $this->stmt = null;
//    }
//}
