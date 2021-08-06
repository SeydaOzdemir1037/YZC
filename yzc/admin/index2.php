<?php
require_once("includes/DBController.php");
include "includes/header.php";
$error = "";
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tur = trim($_POST["tur"]);
    if (empty(trim($_POST['metin']))) {
        $error = "Hakkımda Metni Boş Bırakılamaz";
    } else {
        $metin = trim($_POST["metin"]);
    }
    if ($error == "") {
        $flag = $conn->hakkimdaguncelle($metin, $tur);
        if ($flag) {
            $message = "Metin başarıyla Güncellendi";
        } else {
            $error = "Hata";
        }
    }
}
$sayfa = $conn->hakkimdabul("hakkimda");


?>
<div class="container-fluid">
    <?php if ($error != "") { ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php } ?>
    <?php if ($message != "") { ?>
        <div class="alert alert-success"><?php echo $message; ?></div>
    <?php } ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-black">Hakkımda Güncelle</h4>
        </div>
        <div class="card-body">
            <form class="form-horizontal" enctype='multipart/form-data' method="POST" action="index2.php">
                <div class="form-group">
                    <div class="col-sm-12">
				      <textarea id="editor1" name="metin" placeholder="Metin giriniz"
                                required><?php echo $sayfa['hakkimda']; ?>
				      </textarea>
                    </div>
                    <input type="hidden" name="tur" value="<?php echo $sayfa['tur']; ?> ">
                    <br>
                    <div class="col-sm-offset-2 col-sm-10 col-md-12">
                        <button style="float: right" type="submit" class="btn btn-primary">Kaydet</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php include "includes/footer.php"; ?>

<script>
    ClassicEditor.create(document.querySelector('#editor1'))
        .catch(error => {
            console.error(error);
        });
    $(document).ready(function (e) {
        $(".sil").on('click', (function (e) {
            e.preventDefault();
            var el = $(this);
            var imagelink = $(this).attr('id');
            $.post('/admin/sil.php',
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

