<?php
require_once("../includes/DBController.php");
include "../includes/header.php";
$error = "";
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!isset($_GET["id"])) {
        header('Location: ../index.php');
        die();
    }
    $id = $_GET["id"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $allowed_extension = array("jpg", "jpeg", "pdf", "doc", "docx", "png");
    $count = 0;
    $id = trim($_POST["id"]);
    if (!empty($_FILES['galeri']['name'][0])) {
        if (!file_exists('../../documents/anilar/' . $id)) {
            mkdir('../../documents/anilar/' . $id, 0777, true);
        }
        foreach ($_FILES['galeri']['name'] as $filename) {
            $temp = '../../documents/anilar/' . $id . '/';
            $tmp = $_FILES['galeri']['tmp_name'][$count];
            $file_extension = pathinfo($_FILES['galeri']['name'][$count], PATHINFO_EXTENSION);
            if (in_array($file_extension, $allowed_extension)) {
                $count = $count + 1;
                $temp = $temp . basename($filename);
                move_uploaded_file($tmp, $temp);
                $message = "Resimler Başarıyla Eklendi";
            } else {
                $error .= "<b>" . $_FILES['galeri']['name'][$count] . "</b>---Desteklenen formatlar: png,jpg,jpeg,pdf,doc,docx<br>";
            }
            $temp = '';
            $tmp = '';

        }
    }
    $id = $_POST['id'];
}


?>
<div class="container-fluid">
    <?php if ($error != "") { ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php } ?>
    <?php if ($message != "") { ?>
        <div class="alert alert-success"><?php echo $message; ?></div>
    <?php } ?>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <form class="form-horizontal " enctype='multipart/form-data' method="POST" action="resimler.php">
            <h1 class="h3 mb-0 text-gray-800">
                <label for="" class="form-group">Resim Ekle
                    <input type="file" class="form-control" name="galeri[]" multiple>
                    <input type="hidden" value="<?= $id ?>" name="id">
                </label>
                <button class="btn btn-primary">Ekle</button>
            </h1>
        </form>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-black">Resimler</h4>
        </div>
        <div class="card-body row">
            <?php foreach (glob("../../documents/anilar/" . $id . "/*.*") as $file) {
                $endimg = explode('/', $file);
                $link = "documents/" . $endimg[3] . "/" . $endimg[4] . "/" . $endimg[5];
                ?>
                <div class="col-sm-4 col-md-2  mt-3 filtre ">
                    <div class="sil" id="<?= $link ?>">
                        <span class="fas fa-window-close "></span>
                    </div>
                    <?php if (pathinfo($file, PATHINFO_EXTENSION) == "jpg" || pathinfo($file, PATHINFO_EXTENSION) == "jpeg" || pathinfo($file, PATHINFO_EXTENSION) == "png") { ?>
                        <img width="90%" src="<?= $file ?>">
                    <?php } else { ?>
                        <a href="<?php echo $file; ?>" style="color:black"><?php echo $endimg[5]; ?></a>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>

    </div>
</div>


<?php include "../includes/footer.php"; ?>


<script>
    $(document).ready(function (e) {
        $(".sil").on('click', (function (e) {
            e.preventDefault();
            var el = $(this);
            var imagelink = $(this).attr('id');
            $.post('../sil.php',
                {
                    'imagelink': imagelink
                })
                .success(
                    function (data) {
                        alert(data);
                        el.parent().remove();
                    }
                );
        }));
    });
</script>
