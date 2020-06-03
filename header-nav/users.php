<?php
class Database
{   #კავშირი ბაზასთან

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

    #რეგისრაციი და არსებული ემაილს ან სახელის შემოწმება ბაზაში და ამის შესაბამისად ვალიდაცია


    public function register($name, $email, $passw){

        $stmt = $this->getConnection()->prepare("SELECT * FROM users WHERE name = ? ");
        $stmt->execute([$name]);
        $ckname = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $this->getConnection()->prepare("SELECT * FROM users WHERE email = ? ");
        $stmt->execute([$email]);
        $ckemail = $stmt->fetch(PDO::FETCH_ASSOC);

        if(($ckname != false) AND ($ckemail != false)){
            $_SESSION['nerror'] = 'Name already exists';
            $_SESSION['eerror'] = 'Email Address Already in Use';
            header("Location: /market/login_register/sign_up.php");
            exit;
        }

        if (($ckname != false) AND ($ckemail === false)) {
            session_unset();
            $_SESSION['nerror'] = 'Name already exists';
            header("Location: /market/login_register/sign_up.php");
            exit;

        }
        if (($ckemail != false) AND ($ckname === false)){
            session_unset();
            $_SESSION['eerror'] = 'Email Address Already in Use';
            header("Location: /market/login_register/sign_up.php");
            exit;
        }
        if(($ckname === false) AND ($ckemail === false)) {
            session_unset();
            $passwd = password_hash($passw, PASSWORD_BCRYPT);
            $stmt = "INSERT INTO users (name, email, password) VALUES (?,?,?)";
            $stmt= $this->getConnection()->prepare($stmt);
            $stmt->execute([$name, $email, $passwd]);
            $_SESSION['registered'] = 'registered successfully';
            header("Location: /market/login_register/login.php");


        }
        }

        #დალოგინება მომხმარებლის,რომელიც უკვე დარეგისრირებული არის

        public function loginUser($email, $password)
    {
        $stmt = $this->getConnection()->prepare("SELECT * FROM users WHERE email = ? ");
        $stmt->execute([$email]);
        $ckemail = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($ckemail === false ){
            session_unset();
            $_SESSION['emerror'] = 'Email Address  not found';
            header("Location: /market/login_register/login.php");
            exit;
        }
        if (($ckemail != false) AND (password_verify($password, $ckemail['password']) === false)){
            session_unset();
            $_SESSION['perror'] = 'password is incorrect';
            header("Location: /market/login_register/login.php");
            exit;
        }
        session_unset();
        $_SESSION['currentUser'] = $ckemail['name'];
        $_SESSION['id'] = $ckemail['id'];
        header("Location: /market/public/index.php");
        return true;
    }

}

$user = new Database();

