<?php
require_once("../includes/DBController.php");
include "../includes/header.php";
$error = "";
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $anisira=$conn->anisirabul();
    $sira=$anisira['sira']+1;

    if (empty(trim($_POST["baslik"]))) {
        $error .= "Başlık giriniz.";
    } else {
        $baslik = trim($_POST["baslik"]);
    }
    if (empty(trim($_POST["metin"]))) {
        $error .= "Anı giriniz.";
    } else {
        $ani = trim($_POST["metin"]);
    }
    if (empty($error)) {
        $kapak = null;
        if ($_POST['kapakdata'] != "" && $_POST['kapakdata'] != null) {
            $kapak = $_POST['kapakdata'];
        }
        $flag = $conn->aniekle($baslik, $ani, 1, $kapak,$sira);
        if ($flag) {
            $message = "Anı Başarıyla Eklendi";
            $allowed_extension = array("jpg", "jpeg", "png", "pdf", "doc", "docx");
            $count = 0;
            if (!empty($_FILES['galeri']['name'][0])) {
                if (!file_exists('../../documents/anilar/' . $flag)) {
                    mkdir('../../documents/anilar/' . $flag, 0777, true);
                }
                foreach ($_FILES['galeri']['name'] as $filename) {
                    $temp = '../../documents/anilar/' . $flag . '/';
                    $tmp = $_FILES['galeri']['tmp_name'][$count];
                    $file_extension = pathinfo($_FILES['galeri']['name'][$count], PATHINFO_EXTENSION);
                    if (in_array($file_extension, $allowed_extension)) {
                        $count = $count + 1;
                        $temp = $temp . basename($filename);
                        move_uploaded_file($tmp, $temp);
                    } else {
                        $error .= "<b>" . $_FILES['galeri']['name'][$count] . "</b>---Desteklenen formatlar: png,jpg,jpeg,pdf,doc,docx<br>";
                    }
                    $temp = '';
                    $tmp = '';
                }
            }
        } else {
            $error .= "Hata";
        }
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
                <h4 class="m-0 font-weight-bold text-black">Anı Ekle</h4>
            </div>
            <div class="card-body">
                <form class="form-horizontal " enctype='multipart/form-data' method="POST" action="ekle.php">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="ad">Başlık:</label>
                        <div class="col-sm-6 col-md-6">
                            <input type="text" class="form-control" name="baslik" placeholder="Başlık giriniz" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2 " for="metin">Metin:</label>
                        <div class="col-sm-10 col-md-12">
				      <textarea id="editor1" name="metin" placeholder="Metin giriniz"
                                required>
				      </textarea>
                        </div>
                    </div>
                    <div class="form-group kapak_photo">
                        <div class="col-md-12 row ">
                            <label class="control-label col-md-2" for="kapakcheck"> Kapak Fotoğrafı:</label>
                            <input type="checkbox" class="col-md-1" name="kapakcheck" id="kapakcheck"
                                   value="1">
                        </div>
                        <div id="slayt" class="col-md-6">
                            <img id="kapakshow" width="150px">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 row">
                            <label class="control-label col-sm-2" for="galeri">Galeri:</label>
                            <div class="col-sm-10">
                                <input type="file" name="galeri[]" multiple>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="kapakdata" class="hidden-image-data">
                    <div class="col-sm-offset-2 col-sm-10 col-md-12">
                        <button style="float: right" type="submit" class="btn btn-primary">Ekle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>

<!-- End of Main Content -->
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
                        <button type="button" id="kapakok" class="btn btn-sm btn-success" data-dismiss="modal">Tamam
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
<!-- End of Main Content -->

<?php include "../includes/footer.php"; ?>

<script>
    ClassicEditor.create(document.querySelector('#editor1'))
        .catch(error => {
            console.error(error);
        });
    $("#kapakcheck").change(function () {
        if (this.checked) {
            $('#myModal').modal();
        } else {
            $('.hidden-image-data').val("");
            $('.cropit-preview-image').attr("src", "");
            $('#kapakshow').attr("src", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=");
            $('#kapakshow').attr("width", 1);
        }
    });

    $(function () {
        $('#kapakok').prop('disabled', true);
        $('.image-editor').cropit();
        $('#kapakform').submit(function () {
            var imageData = $('.image-editor').cropit('export');
            $('.hidden-image-data').val(imageData);
            $('#kapakshow').attr("src", imageData);
            $('#kapakshow').attr("width", 150);
            $('#kapakok').prop('disabled', false);
            return false;
        });
    });

</script>