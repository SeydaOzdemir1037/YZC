<?php
require_once("../includes/DBController.php");
include "../includes/header.php";
$error = "";
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $say = 1;
    $sirala = $_POST['id'];
    foreach ($sirala as $row) {
        $flag = $conn->albumsiraguncelle($say, $row);
        $say++;
    }
}

if (isset($_GET["sil"])) {
    $flag = $conn->albumsil($_GET["sil"]);
    if ($flag) {
        $message = "Albüm Silindi";
    } else {
        $error = "Başarısız";
    }
}
if (isset($_GET["pasif"])) {
    $flag = $conn->albumpasif($_GET["pasif"]);
    if ($flag) {
        $message = "Albüm Pasif Edildi";
    } else {
        $error = "Başarısız";
    }
}
if (isset($_GET["aktif"])) {
    $flag = $conn->albumaktif($_GET["aktif"]);
    if ($flag) {
        $message = "Albüm Aktif Edildi";
    } else {
        $error = "Başarısız";
    }
}
$albumler = $conn->albumler();
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
            <h4 class="m-0 font-weight-bold text-black">Tüm Albümler</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th style="width: 1%">ID</th>
                        <th style="width: 15%">Kapak</th>
                        <th>Başlık</th>
                        <th style="width: 10%">Tarih</th>
                        <th style="width: 20%">-</th>
                    </tr>
                    </thead>
                    <tbody class="tablesira">
                    <?php foreach ($albumler as $album) { ?>
                        <tr id="id_<?= $album['id'] ?>">
                            <td><?= $album['id'] ?></td>
                            <td><img width="120px" src="<?= $album['kapak'] ?>" alt=""></td>
                            <td><?= $album['baslik'] ?></td>
                            <td><?php echo date("d-m-Y", strtotime($album['tarih'])); ?></td>
                            <td>
                                <a href="album.php?id=<?= $album['id'] ?>">
                                    <button class="btn btn-primary btn-sm mr-1">Düzenle</button>
                                </a>
                                <button data-url="guncelle.php?sil=<?= $album['id'] ?>"
                                        class="btn btn-danger btn-sm mr-1 sil-sweet">Sil
                                </button>
                                <?php if ($album['act'] == 1) { ?>
                                    <a href="guncelle.php?pasif=<?= $album['id'] ?>">
                                        <button class="btn btn-success btn-sm">Aktif</button>
                                    </a>
                                <?php }
                                if ($album['act'] == 0) { ?>
                                    <a href="guncelle.php?aktif=<?= $album['id'] ?>">
                                        <button class="btn btn-warning btn-sm">Pasif</button>
                                    </a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php include "../includes/footer.php"; ?>


<script>
    $('.tablesira').sortable({
        update: function () {
            $.ajax({
                url: "guncelle.php",
                data: $(this).sortable('serialize'),
                type: "POST"
            });
        }
    });
</script>