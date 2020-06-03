<?php
#ხელით შექმენით phpmyadinm.ში ბაზა,რომლის სახელიც ინქნება market, შემდეგ გაუშვით ეს php.ფაილი.
class config_1
{
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

    function createtable1()
    {

        $stmt = $this->getConnection()->prepare("CREATE table users(
        id INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR( 50 ) NOT NULL,
        email VARCHAR( 60 ) NOT NULL,
        password VARCHAR( 64 ) NOT NULL
        );" );

    $stmt->execute();
    }
    function createtable2()
    {

        $stmt = $this->getConnection()->prepare("CREATE table product(
        p_id INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
        p_name VARCHAR( 50 ) NOT NULL,
        price VARCHAR( 10 ) NOT NULL,
        categories VARCHAR( 64 ) NOT NULL,
        you_name VARCHAR( 60 ) NOT NULL,
        description VARCHAR( 255 ) NOT NULL,
        address VARCHAR( 30 ) NOT NULL,
        mobile VARCHAR( 30 ) NOT NULL,
        image VARCHAR( 100 ) NOT NULL,
        time VARCHAR( 30 ) NOT NULL,
        view INT( 6 ) DEFAULT 0,
        id INT( 11 ) NOT NULL );" );
        $stmt->execute();
    }
    function createtable3()
    {

        $stmt = $this->getConnection()->prepare("CREATE table tview(
        id INT( 11 ) DEFAULT 1,
        view INT( 11 ) DEFAULT 0
        );" );

        $stmt->execute();
    }



}
$create = new config_1();
$create->createtable1();
$create->createtable2();
$create->createtable3();