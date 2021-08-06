<?php
require_once("includes/DBController.php");
include "includes/header.php";
$error = "";
$message = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["password"]))){
        $error .= "Şifre giriniz.<br>";
    } else{
        $password = trim($_POST["password"]);
    }
    if(empty(trim($_POST["passwordrepeat"]))){
        $error .= "Tekrar Şifre giriniz.<br>";
    } else{
        $passwordrepeat = trim($_POST["passwordrepeat"]);
    }
    if(strlen($password) < 6 || strlen($passwordrepeat) < 6){
        $error .= "En az 6 karakter giriniz<br>";
    }
    if($password != $passwordrepeat){
        $error .= "Şifreler uyuşmamaktadır.<br>";
    }
    if(empty($error)){

        $flag = $conn->changepassword($_SESSION["username"],$password);
        if($flag){
            $message = "Şifre değiştirildi.";
        }
        else{$error .= "Hata";}
    }
}

?>
<div class="container-fluid">
    <?php if ($error != "") { ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php } ?>
    <?php if ($message != "") { ?>
        <div class="alert alert-success"><?php echo $message; ?></div>
    <?php } ?>
    <div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-black">Şifre Değiştir</h4>
            </div>
            <div class="card-body">
                <form class="form-horizontal"method="POST" action="password.php">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="ad">Şifre</label>
                        <div class="col-sm-6 col-md-6">
                            <input type="password" class="form-control" name="password" placeholder="Şifre Giriniz" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="ad">Şifre Tekrar</label>
                        <div class="col-sm-6 col-md-6">
                            <input type="password" class="form-control" name="passwordrepeat" placeholder="Tekrar Şifre Giriniz" required>
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10 col-md-6">
                        <button style="float: right" type="submit" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>


<?php include "includes/footer.php"; ?>

