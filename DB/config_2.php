<?php
#თუ არ გაქვთ config_1 ფაილი გაშვებული ჯერ ის გაუშვით და შემდეგ ეს ფაილი
class config_2{
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $connection;


    public function __construct()
    {

        $this->servername = 'localhost';
        $this->username = 'root';
        $this->password = '';
        $this->dbname = 'market';

        $this->connection = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);

        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }


    public function getConnection()
    {
        return $this->connection;
    }
    function addAdmin(){
        $name = 'Admin';
        $email = 'admin@gmail.com';
        $passw = 'admin';
        $passwd = password_hash($passw, PASSWORD_BCRYPT);
        $stmt = "INSERT INTO users (name, email, password) VALUES (?,?,?)";
        $stmt = $this->getConnection()->prepare($stmt);
        $stmt->execute([$name, $email, $passwd]);
    }

}
$create = new config_2();
$create->addAdmin();
