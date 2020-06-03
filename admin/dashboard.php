<?php
require_once('../header-nav/header-nav.php');
require_once('../header-nav/product.php');
#შემოწმება,რომ ადმინი გარდა სხვა იუზერმა და არადლოგინებულმა იუზერმა ვერ მიიღოს წვდომა ამ ფაილზე
if (!isset($_SESSION['currentUser']) ){
    header("Location: /market/error_404/unknow.php");
}

if (isset($_SESSION['currentUser']) && ($_SESSION['currentUser']) !== 'Admin' ){
    header("Location: /market/error_404/unknow.php");
}


$userss =$users->getusers();
$n = 1;

?>
<!-- # გამოვიტანთ სტუმრების რაოდნებოა -->
<div class="container" style="margin: 8px;">
    <h4>TOTAL PAGE VIEWS</h4>
    <div class="d-flex">
    <i style="font-size: 45px; margin-right: 15px; color: orange" class="fas fa-street-view"></i>
        <h1><?php echo $users->viewcountallvisitor() ?></h1>
    </div>
</div>
<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>NAME</th>
            <th>Email</th>
            <th>Number of Products</th>
            <th>action</th>
        </tr>
        </thead>
        <tbody>
     <!--   #ვბეჭდავთ  მომხარებელს -->
        <?php foreach ($userss as $user):
            ?>
        <tr>
            <td><?php echo $n++; ?></td>
            <td class="txt-oflo"><?php echo $user['name'] ?></td>
            <td><?php echo $user['email'] ?></td>
            <td class="txt-oflo"><?php echo count($users->curIdproduct($user['id'])); ?></td>
            <td><div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                        <button type="button" name="login" class="btn btn-secondary"><a style="color: white" href="../manage_product/myproduct.php?id=<?php echo $user['id'] ?>">View</a> </button>
                    </div>

                    <div class="btn-group mr-2" role="group" aria-label="Second group">
                        <button type="button" name="signup" class="btn btn-danger"><a style="color: white" href="udelete.php?id=<?php  echo $user['id']; ?>">Delete</a></button>
                    </div> </div></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include_once('../header-nav/footer.php') ?>
