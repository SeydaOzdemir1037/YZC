<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<?php
// Initialize the session
session_start();

if(isset($_SESSION["giris"]) && $_SESSION["giris"] === true && isset($_SESSION["username"])){
    header("location: index2.php");
    exit;
}

$username = $password = "";
$error = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty(trim($_POST["username"]))){
            $error = "Kullanıcı adı giriniz.";
        } else{
            $username = trim($_POST["username"]);
        }

        if(empty(trim($_POST["password"]))){
            $error = "Şifre giriniz.";
        } else{
            $password = trim($_POST["password"]);
        }
        if(empty($error)){
            require_once("includes/LoginController.php");
            $LC = new LoginController();
            $result = $LC->check($username,$password);
            $error = $result;
        }
}
?>

<div class="container">
    <div class="panel col-md-6 col-md-offset-3" style="margin-top: 50px">
        <?php if($error != ""){?>
            <div class="alert alert-warning"><?php echo $error; ?></div>
        <?php } ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Kullanıcı Adı</label>
                <input type="text" name="username" required="required" class="form-control" value="<?php echo $username; ?>">
            </div>
            <div class="form-group">
                <label>Şifre</label>
                <input type="password" name="password" required="required" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary col-md-12" value="Giriş">
            </div>
        </form>
    </div>
</div>




