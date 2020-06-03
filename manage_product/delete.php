<?php include ('../header-nav/header-nav.php');
require_once ('../header-nav/product.php');
$produc = $product->getOneproduct($_GET['id']);
#აქ ვამოწმებ,რომ დალოგინებულმა უსერმა url.ში აიდის გატანებით არ წაშალოს სხვისი პროდუქტი
if (!isset($_SESSION['currentUser'])){
    header("Location: /market/error_404/unknow.php");
}

if ( ($_SESSION['currentUser'] !== $users->otherouser($produc[0]['id']) && $_SESSION['currentUser'] !== 'Admin' )){
    header("Location: /market/error_404/unknow.php");
}
if(isset($_POST['yes']) && $_SESSION['currentUser'] !== 'Admin'){
    unlink( $produc[0]['image']);
    $product->deleteproduct($_GET['id']);
}

if(isset($_POST['yes']) && $_SESSION['currentUser'] == 'Admin'){
    unlink( $produc[0]['image']);
    $product->deleteproductfromadmin($_GET['id']);
}
if(isset($_POST['no']) && $_SESSION['currentUser'] == 'Admin' ){
    header("Location: /market/admin/dashboard.php");

}if (isset($_POST['no']) && $_SESSION['currentUser'] !== 'Admin' ){
    header("Location: myproduct.php");
}
?>



<section class="jumbotron text-center">
    <div class="container">
        <h1 style="color: orange" class="jumbotron-heading">Warning</h1>
        <p class="lead text-muted">Are you sure you want to delete this product?</p>
        <p>
           <form method="post" action="">
            <button type="submit" name="yes" class="btn btn-danger my-2">Yes</button>
            <button type="submit" name="no" class="btn btn-success my-2">No</button>
        </form>
        </p>
    </div>
</section>
<?php include ('../header-nav/footer.php');?>
