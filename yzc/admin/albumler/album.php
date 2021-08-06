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
    $album = $conn->albumbul($_GET["id"]);
}


if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["baslik"]))){
        $error .= "Başlık giriniz.";
    } else{
        $baslik = trim($_POST["baslik"]);
    }
    if(empty(trim($_POST["tarih"]))){
        $error .= "Tarih giriniz.";
    } else{
        $tarih = trim($_POST["tarih"]);
    }
    if(empty(trim($_POST["id"]))){
        $error .= "id giriniz.";
    } else{
        $id = trim($_POST["id"]);
    }
    if(empty($error)){
        $kapak = null;
        if($_POST["kapakdata"] != "" && $_POST["kapakdata"] != null){
            $kapak = $_POST["kapakdata"];
        }
        $flag = $conn->albumguncelle($baslik, $kapak, $tarih, $id);
        if($flag){
            $message="Albüm Başarıyla Güncellendi";
        }
        else{
            $error="Hata";
        }
    }
    $album = $conn->albumbul($id);
}



?>
<div class="container-fluid">

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
                    <h4 class="m-0 font-weight-bold text-black"><?= $album['baslik'] ?>
                        <a href="resimler.php?id=<?= $album['id'] ?>">
                            <button style="float: right" class="btn btn-success">Album Resimleri</button>
                        </a>
                    </h4>

                </div>
                <div class="card-body">
                    <form class="form-horizontal " enctype='multipart/form-data' method="POST" action="album.php">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="ad">Başlık:</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" name="baslik"
                                       value="<?php echo $album['baslik']; ?>" placeholder="Başlık giriniz" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="tarih">Tarih:</label>
                            <div class="col-sm-2">
                                <input type="date" class="form-control"
                                       value="<?php echo date("Y-m-d", strtotime($album['tarih'])); ?>" id="tarih"
                                       name="tarih" required>
                            </div>
                        </div>
                        <div class="form-group kapak_photo">
                            <div class="row">
                                <label class="control-label col-md-2" for="kapakcheck"> Kapak Fotoğrafı:</label>
                                <input type="checkbox" class="col-md-1" name="kapakcheck" id="kapakcheck"
                                       value="1" <?php if ($album['kapak'] != null) {
                                    echo "checked";
                                } ?>>
                            </div>
                            <div id="slayt" class="col-md-6">
                                <img id="kapakshow" width="150px" src="<?php if ($album['kapak'] != null) {
                                    echo $album['kapak'];
                                } ?>">
                            </div>
                        </div>
                        <input type="hidden" name="kapakdata" class="hidden-image-data"
                               value="<?php if ($album['kapak'] != null) {
                                   echo $album['kapak'];
                               } ?>">
                        <input type="hidden" name="id" value="<?php echo $album['id']; ?> ">
                        <div class="col-sm-offset-2 col-sm-10 col-md-12">
                            <button style="float: right" type="submit" class="btn btn-primary">Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <form id="kapakform" action="#">
                        <div style="width: 100%" class="image-editor">
                            <input type="file" class="cropit-image-input">
                            <div class="cropit-preview"></div>
                            <div class="image-size-label">
                                Resmi Boyutlandır
                            </div>
                            <input style="width: 100%" type="range" class="cropit-image-zoom-input">
                            <button type="submit" class="btn btn-sm btn-danger">Kırp</button>
                            <button type="button" id="kapakok" class="btn btn-sm btn-success" data-dismiss="modal">
                                Tamam
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <span style="float: left; color:red;"><b>kapak fotoğraf eklemek için önce kırpın.</b></span>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- End of Main Content -->

<?php include "../includes/footer.php"; ?>

<script>
    $("#kapakcheck").change(function() {
        if(this.checked) {
            $('#myModal').modal();
        }
        else{
            $('.hidden-image-data').val("");
            $('.cropit-preview-image').attr("src","");
            $('#kapakshow').attr("src","data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=");
            $('#kapakshow').attr("width",1);
        }
    });

    $(function() {
        $('#kapakok').prop('disabled', true);
        $('.image-editor').cropit();
        $('#kapakform').submit(function() {
            var imageData = $('.image-editor').cropit('export');
            $('.hidden-image-data').val(imageData);
            $('#kapakshow').attr("src",imageData);
            $('#kapakshow').attr("width",150);
            $('#kapakok').prop('disabled', false);
            return false;
        });
    });
</script>