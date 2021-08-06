<?php
require_once("../includes/DBController.php");
include "../includes/header.php";
$error = "";
$message = "";


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $say=1;
    $sirala=$_POST['id'];
    foreach ($sirala as $row) {
        $flag=$conn->anisiraguncelle($say,$row);
        $say++;
    }
}


if(isset($_GET["sil"])){
    $flag = $conn->anisil($_GET["sil"]);
    if($flag){
        $message = "Anı Silindi";
    }
    else{
        $error = "Başarısız";
    }
}
if(isset($_GET["pasif"])){
    $flag = $conn->anipasif($_GET["pasif"]);
    if($flag){
        $message = "Anı Pasif Edildi";
    }
    else{
        $error = "Başarısız";
    }
}
if(isset($_GET["aktif"])){
    $flag = $conn->aniaktif($_GET["aktif"]);
    if($flag){
        $message = "Anı Aktif Edildi";
    }
    else{
        $error = "Başarısız";
    }
}
$anilar = $conn->anilar();
?>
<div class="container-fluid">
    <?php if($error != ""){?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php } ?>
    <?php if($message != ""){?>
        <div class="alert alert-success"><?php echo $message; ?></div>
    <?php } ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-black">Tüm Anılar</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th style="width: 1%">ID</th>
                        <th style="width: 15%">Kapak</th>
                        <th>Başlık</th>
                        <th style="width: 20%">-</th>
                    </tr>
                    </thead>
                    <tbody class="tablesira">
                    <?php foreach ($anilar as $ani) { ?>
                        <tr id="id_<?=$ani['id']?>">
                            <td><?=$ani['id']?></td>
                            <td><img width="120px" src="<?=$ani['kapak']?>" alt=""></td>
                            <td><?=$ani['baslik']?></td>
                            <td>
                                <a href="ani.php?id=<?=$ani['id']?>"><button class="btn btn-primary btn-sm mr-1">Düzenle</button></a>
                                <button data-url="guncelle.php?sil=<?=$ani['id']?>" class="btn btn-danger btn-sm mr-1 sil-sweet">Sil</button>
                                <?php if($ani['act']==1){?>
                                    <a href="guncelle.php?pasif=<?=$ani['id']?>"> <button class="btn btn-success btn-sm">Aktif</button></a>
                                <?php }if($ani['act']==0){?>
                                    <a href="guncelle.php?aktif=<?=$ani['id']?>"><button class="btn btn-warning btn-sm">Pasif</button></a>
                                <?php }?>
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