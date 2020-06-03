<?php
require_once('../header-nav/product.php');
include_once('../header-nav/header-nav.php');
$produc = $product->getOneproduct($_GET['id']);
if (!isset($_SESSION['currentUser'])){
    header("Location: /market/error_404/unknow.php");
}

if ( $_SESSION['currentUser'] !== $users->otherouser($produc[0]['id']) ){
    header("Location: /market/error_404/unknow.php");
}

$a_id = $produc[0]['id'];
if (isset($_POST['submit'])){
    if (isset($_FILES['image']) && $_FILES['image']['name']) {
        unlink( $produc[0]['image']);
        $file = $_FILES['image'];
        $filename = $file['name'];
        $dotpst = strpos($filename, '.');
        $extend = substr($filename, $dotpst + 1);
        $rand = rand(1, 99999);
        $dir = "../manage_product/images/${rand}.$extend";
        move_uploaded_file($file['tmp_name'], __DIR__ . "/images/${rand}.$extend");
    }else{
        $dir = $produc[0]['image'];
    }


    $product->updateprod($_POST,$_GET['id'],$dir,$a_id);
}
?>

<div class="container py-3">
        <div class="row">
            <div class="mx-auto col-sm-6">
                <!-- form user info -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Update Product</h4>
                    </div>
                    <div class="card-body">
                            <?php foreach ($produc as $pdu): ?>

                        <form  autocomplete="off" action="" method="post" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Product name</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="p_name" value="<?php echo $pdu['p_name']?>" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Product price</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="price" value="<?php echo $pdu['price']?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Categories</label>
                                <div class="col-lg-9">
                                    <select  class="form-control" name="categories"  >
                                        <option >Electronics</option>
                                        <option >Fashion</option>
                                        <option >Book</option>
                                        <option >Computer</option>
                                        <option >Mobile</option>
                                        <option >Household goods</option>
                                        <option >Cars</option>
                                        <option >Musical instruments</option>
                                        <option >Sporting goods</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Your name</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="name" value="<?php echo $pdu['you_name']?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Description</label>
                                <div class="col-lg-9">
                                    <textarea class="form-control" name="desc" rows="5" maxlength="200" > </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Address</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="address" value="<?php echo $pdu['address']?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Mobile</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="number" name="mobile" value="<?php echo $pdu['mobile']?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Image</label>
                                <div class="col-lg-9">
                                <input name="image" type="file" class="form-control-file">
                                </div>
                            </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                <div class="col-lg-9">
                                    <button type="submit" class="btn btn-primary" name="submit">Update </button>
                                </div>
                            </div>
                        </form>
                    <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require_once('../header-nav/header-nav.php'); ?>