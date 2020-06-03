<?php
# ეს არის კლასი,რომშიც შექმილინა თითქმის ყველა საჭირო მეთოდი
class  Product
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

    #პროდუქტის დამატება
    public function addproduct($data, $dir, $id)
    {
        $time = date('Y-m-d');
        $p_name = $data['p_name'];
        $price = $data['price'];
        $categories = $data['categories'];
        $you_name = $data['name'];
        $desc = $data['desc'];
        $add = $data['address'];
        $mobile = $data['mobile'];
        $stmt = $this->getConnection()->prepare("INSERT INTO product(p_name, price, categories,you_name,description,address,mobile,
        image,time,id)
      VALUES (?,?,?,?,?,?,?,?,?,?)");
        $stmt->execute([$p_name, $price, $categories, $you_name, $desc, $add, $mobile, $dir, $time, $id]);

        header("Location: /market/public/index.php");
    }

    #ყველა პროდუქტის მიღება
    function AllProduct()
    {



        $stmt =  $this->getConnection()->prepare("SELECT * FROM product ORDER BY p_id DESC");
        $stmt->execute();
        $products = $stmt->fetchall(PDO::FETCH_ASSOC);
        return $products;

    }
    #პროდუქტის გაფიტვრა კატეგორის მიხედვით
    function curProduct($catg)
    {


        $stmt = $this->getConnection()->prepare("SELECT * FROM `product` WHERE `categories` = ?");
        $stmt->execute([$catg]);
        $products = $stmt->fetchall(PDO::FETCH_ASSOC);

        return $products;


    }
    #კონკრეტული მომხარებლის პროდუქტი
    function curIdproduct($id)
    {
        $stmt = $this->getConnection()->prepare("SELECT * FROM `product` WHERE `id` = ?");
        $stmt->execute([$id]);
        $products = $stmt->fetchall(PDO::FETCH_ASSOC);

        return $products;
    }

    #კონკრეტული პროდუქტის მიღება
    function getOneproduct($id)
    {
        $stmt = $this->getConnection()->prepare("SELECT * FROM `product` WHERE `p_id` = ?");
        $stmt->execute([$id]);
        $product = $stmt->fetchall(PDO::FETCH_ASSOC);

        return $product;

    }
    #კონკრეტული პროდუქტის ნახვების დათვლა
    function countview($id)
    {
        $stmt = $this->getConnection()->prepare("UPDATE product SET view = view+1 WHERE p_id = ?");
        $stmt->execute([$id]);


    }

    #განახლება პროდუქტის
    function updateprod($data, $id, $dir, $a_id)
    {

        $name = $data['p_name'];
        $price = $data['price'];
        $categories = $data['categories'];
        $y_name = $data['name'];
        $desc = $data['desc'];
        $add = $data['address'];
        $mobile = $data['mobile'];
        $time = date('Y-m-d');

        $stmt = $this->getConnection()->prepare("UPDATE product SET P_name=?, price=?, categories=?, you_name=?,
 description=?, address=?, mobile=?,image=?, time=?, id=? WHERE P_id=?");
        $stmt->execute([$name, $price, $categories,$y_name,$desc,$add,$mobile,$dir,$time,$a_id, $id]);
        header("Location: /market/manage_product/myproduct.php");



    }

        #წაშლა პროდუქტის
    function deleteproduct($id)
    {

        $stmt = $this->getConnection()->prepare("DELETE FROM product  WHERE p_id = ?");
        $stmt->execute([$id]);

        header("Location: /market/manage_product/myproduct.php");
    }
    #დავამატე ფუნქცია წაშლი ადინიდა, რადგან გადამისამართება სხვაგან უნდა მოხდეს ამ შემტხევაში,როც ადმინი შლის
    function deleteproductfromadmin($id)
    {

        $stmt = $this->getConnection()->prepare("DELETE FROM product  WHERE p_id = ?");
        $stmt->execute([$id]);

        header("Location: /market/admin/dashboard.php");
    }
    #მომხარებლეის მიღება
    function getusers()
    {
        $stmt =  $this->getConnection()->prepare("SELECT * FROM users");
        $stmt->execute();
        $users = $stmt->fetchall(PDO::FETCH_ASSOC);

        return $users;
    }
    #მომხარებლის წაშლა
    function deleteuser($id)
    {
        $stmt = $this->getConnection()->prepare("DELETE FROM users  WHERE id = ?");
        $stmt->execute([$id]);
        header("Location: /market/admin/dashboard.php");
    }

    #საიტის ვისიტოების დათვლა
     function countvisit() {

         $view = $this->getConnection()->prepare("UPDATE tview SET view = view+1 ");
         $view->execute();

     }
     #მიღება ამ ვისიტორების
     function viewcountallvisitor(){
         $stmt =  $this->getConnection()->prepare("SELECT * FROM tview ");
         $stmt->execute();

         $conut = $stmt->fetchall(PDO::FETCH_ASSOC);
         return $conut[0]['view'];
     }
     #მომხარებლის მიღება პროდუქტის არსებული id მიხედვით
    function otherouser($id)
    {
        $stmt = $this->getConnection()->prepare("SELECT * FROM `users` WHERE `id` = ?");
        $stmt->execute([$id]);
        $product = $stmt->fetchall(PDO::FETCH_ASSOC);

        return $product[0]['name'];
    }
    #ეს ფუნქცია გვიბრუნებს სამ ყველაზე მეტჯერ ნახულ პროდუქტს
    function top3(){
        $stmt =  $this->getConnection()->prepare("SELECT *  FROM product ORDER BY view DESC LIMIT 3");
        $stmt->execute();
        $products = $stmt->fetchall(PDO::FETCH_ASSOC);
        return $products;
    }
}
$product = new Product();
$users = new Product();