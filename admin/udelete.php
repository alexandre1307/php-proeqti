<?php include ('../header-nav/header-nav.php');
require_once ('../header-nav/product.php');
if (!isset($_SESSION['currentUser']) ){
    header("Location: /market/error_404/unknow.php");
}
if (isset($_SESSION['currentUser']) && ($_SESSION['currentUser']) !== 'Admin' ){
    header("Location: /market/error_404/unknow.php");
}

if(isset($_POST['yes'])){

    $users->deleteuser($_GET['id']);
}
if(isset($_POST['no'])){
    header("Location: dashboard.php");
}
?>


    <section class="jumbotron text-center">
        <div class="container">
            <h1 style="color: orange" class="jumbotron-heading">Warning</h1>
            <p class="lead text-muted">Are you sure you want to delete this user?</p>
            <p>
            <form method="post" action="">
                <button type="submit" name="yes" class="btn btn-danger my-2">Yes</button>
                <button type="submit" name="no" class="btn btn-success my-2">No</button>
            </form>
            </p>
        </div>
    </section>
<?php include ('../header-nav/footer.php');?>