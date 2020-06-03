<?php
session_start();
include "users.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>GeoMarket</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
</head>
<body >

<nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-light">
    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group mr-2" role="group" aria-label="First group">
    <button type="button" class="btn btn-outline-primary"><a style="text-decoration: none;color: yellow" href="../public/index.php">Home</a></button>
        </div>

            <?php if (isset($_SESSION['currentUser'])): ?>
        <div class="btn-group mr-2" role="group" aria-label="Second group">
    <button type="button" class="btn btn-outline-info"><a style="text-decoration: none;color: chartreuse" href="../manage_product/addproduct.php?id=<?php echo $_SESSION['id']; ?>">+ Add product</a></button>
        </div>

            <?php  endif; ?>
        <?php if ((isset($_SESSION['currentUser'])) && ($_SESSION['currentUser']) === 'Admin'): ?>
            <div class="btn-group mr-2" role="group" aria-label="Thirt group">
                <button type="button" class="btn btn-outline-success"><a style="text-decoration: none;color: darkgreen; color: white" href="../admin/dashboard.php">Admin</a></button>
            </div>
        <?php  endif; ?>
    </div>

    <div class="collapse navbar-collapse" id="navbarNav">
        <div class="nav navbar-nav ml-auto">
            <?php if (!isset($_SESSION['currentUser'])): ?>
            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group mr-2" role="group" aria-label="First group">
                    <button type="button" name="login" class="btn btn-primary"><a style="color: white; text-decoration: none" href="../login_register/login.php">Log in</a> </button>
                </div>

                <div class="btn-group mr-2" role="group" aria-label="Second group">
                    <button type="button" name="signup" class="btn btn-success"><a style="color: white; text-decoration: none" href="../login_register/sign_up.php">Sign Up</a></button>
                </div>
                <?php else: ?>

                <div class="btn-group mr-2" role="group" aria-label="First group">
                    <button type="button" name="user" class="btn btn-success"><a style="color: white; text-decoration: none" href="#"></a> <?php echo 'Welcome to '.$_SESSION['currentUser']; ?> </button>
                </div>
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                        <button type="button" name="user" class="btn btn-primary"><a style="color: white; text-decoration: none" href="../login_register/signout.php"> Sign out</a> </button>
                    </div>
                <?php if(isset($_SESSION['currentUser']) && ($_SESSION['currentUser'] === 'Admin')):?>

                    <?php else: ?>
                        <div class="btn-group" role="group" aria-label="Third group">
                            <button type="button" name="product" class="btn btn-secondary"><a style="color: white; text-decoration: none" href="../manage_product/myproduct.php">My Product</a></button>
                        </div>
                <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
</nav>
