<?php include_once('../header-nav/header-nav.php');
unset($_SESSION['nerror']);
unset($_SESSION['eerror']);
if(isset($_POST['submit'])){
    $user->loginUser($_POST['email'],$_POST['password']);
}

?>


<div class="container ">
    <div class="d-flex justify-content-center">
        <h2>Authorization</h2>
    </div>
    <?php   if(isset($_SESSION['registered'] )): ?>
    <div class=" alert alert-success ">
        <h1 class="text-center"> <i class="fas fa-laugh-beam"></i> <?php echo $_SESSION['registered']  ?></h1>
    </div>
    <?php endif; ?>
    <form method="post" action="">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email"
            required>
            <p class="text-danger"> <?php if(isset($_SESSION['emerror']))
                    echo $_SESSION['emerror'];
                else
                    echo ''; ?>
            </p>
        </div>
        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
            <p class="text-danger"> <?php if(isset($_SESSION['perror']))
                    echo $_SESSION['perror'];
                else
                    echo ''; ?>
            </p>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


<?php include_once('../header-nav/footer.php') ?>
