<?php
include_once('../header-nav/header-nav.php');
unset($_SESSION['emerror']);
unset($_SESSION['perror']);
unset($_SESSION['registered']);
if(isset($_POST['submit']))

    $user->register($_POST['name'],$_POST['email'],$_POST['password']);
?>

<div class="container">
    <div class="d-flex justify-content-center">
    <h2>Register Here</h2>
    </div>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter name" name="name"
                   value="" required>
            <p class="text-danger"> <?php if(isset($_SESSION['nerror']))
                echo $_SESSION['nerror'];
                else
                    echo ''; ?>
            </p>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email"
            value="" required>
            <p class="text-danger"> <?php if(isset($_SESSION['eerror']))
                    echo $_SESSION['eerror'];
                else
                    echo ''; ?>
            </p>
        </div>
        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


<?php include_once('../header-nav/footer.php') ?>
