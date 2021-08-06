<?php include "includes/header.php";
$limit = 120;


?>

<section id="ana" class="d-flex flex-column justify-content-center align-items-center">
    <div class="ana-container" data-aos="fade-in">
        <h1>Yusuf Ziyaattin Cenik</h1><br>
        <p>Çaldıran Noteri<br>Yargıtay Onursal Genel Sekreteri</p>
    </div>
</section>

<main id="main">
    <section id="hakkimda" class="hakkimda">
        <div class="container">
            <div class="section-title">
                <h2>Hakkımda</h2>
            </div>
            <div class="row">
                <div class="col-lg-4" data-aos="fade-right">
                    <img src="assets/img/yzc.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-lg-8 pt-4 pt-lg-0 content" data-aos="fade-left">
                    <p class="font-italic">
                    <p><?php $hakkimda = $conn->hakkimda();
                        echo $hakkimda['hakkimda'] ?></p>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul>
                                <li><i class="icofont-rounded-right"></i> <strong>Mail Adresi:</strong>
                                    yusufzcenik@gmail.com
                                </li>
                                <li><i class="icofont-rounded-right"></i> <strong>Ünvan:</strong> Çaldıran Noteri</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <section id="anilar" class="yazilar">
        <div class="container">
            <div class="section-title">
                <h2>Anılar</h2>
<!--                <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint-->
<!--                    consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia-->
<!--                    fugiat sit in iste officiis commodi quidem hic quas.</p>-->
            </div>
            <div class="row">
                <?php $anilar = $conn->anilar(6);
                foreach ($anilar as $ani) { ?>
                    <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up">
                        <div class="icon">
                            <img style="border-radius: 10%" width="100%" src="<?= $ani['kapak'] ?>" alt="">
                        </div>
                        <a href="ani.html?id=<?= $ani['id'] ?>">
                            <h4 class="title"><?= $ani['baslik'] ?></h4>
                            <div class="description">
                                <?php if (strlen($ani['ani']) > 150) { ?>
                                    <?= substr($ani['ani'], 0, $limit) ?>...
                                <?php } else { ?>
                                    <?php echo $ani['ani'];
                                } ?>
                            </div>
                        </a>
                    </div>
                <?php } ?>
                <div class="col"><b><a href="anilar.html">Hepsi...</a></b></div>
            </div>
    </section><!-- End Resume Section -->

    <!-- ======= galeri Section ======= -->
    <section id="galeri" class="galeri section-bg">
        <div class="container">
            <div class="section-title">
                <h2>Albümler</h2>
            </div>
            <div class="row galeri-container" data-aos="fade-up" data-aos-delay="100">
                <?php $albumler = $conn->albumler(8);
                foreach ($albumler as $album) { ?>
                    <div class="col-lg-3 col-md-6 galeri-item">
                        <a href="album.html?id=<?= $album['id'] ?>">
                            <img style="height: 200px;width: 250px" src="<?= $album['kapak'] ?>" class="img-fluid"
                                 alt="">
                        </a><br>
                        <span class="galeri-title"><b><?= $album['baslik'] ?> </b>- <?= $album['tarih'] ?></span>
                    </div>
                <?php } ?>
            </div>
            <div class="col"><b><a href="albumler.html">Hepsi...</a></b></div>
        </div>
    </section><!-- End galeri Section -->

    <!-- ======= yazilar Section ======= -->
    <section id="yazilar" class="yazilar">
        <div class="container">
            <div class="section-title">
                <h2>Yazılar</h2>
<!--                <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint-->
<!--                    consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia-->
<!--                    fugiat sit in iste officiis commodi quidem hic quas.</p>-->
            </div>

            <div class="row">
                <?php $yazilar = $conn->yazilar(6);
                foreach ($yazilar as $yazi) { ?>
                    <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up">
                        <div class="icon"><img style="border-radius: 10%" width="100%" src="<?= $yazi['kapak'] ?>"
                                               alt=""></div>
                        <a href="yazi.html?id=<?= $yazi['id'] ?>">
                            <h4 class="title"><?= $yazi['baslik'] ?></h4>
                            <div class="description">
                                <?php if (strlen($yazi['yazi']) > 150) { ?>
                                    <?= substr($yazi['yazi'], 0, $limit) ?>...
                                <?php } else { ?>
                                    <?php echo $yazi['yazi'];
                                } ?>
                            </div>
                        </a>
                    </div>
                <?php } ?>
                <div class="col"><b><a href="yazilar.html">Hepsi...</a></b></div>
            </div>
    </section>


    <section id="iletisim" class="iletisim">
        <?php
        if ($_POST) {
            require("mailphp/class.phpmailer.php"); // PHPMailer dosyamizi çagiriyoruz
            $mail = new PHPMailer(); // Sinifimizi $mail degiskenine atadik
            $mail->IsSMTP(true);  // Mailimizin SMTP ile gönderilecegini belirtiyoruz
            $mail->From = $_POST["email"];//"admin@localhost"; //Gönderen kisminda yer alacak e-mail adresi
            $mail->Sender = $_POST["email"];//"admin@localhost";//Gönderen Mail adresi
//$mail->ReplyTo  = ($_POST["mailiniz"]);//"admin@localhost";//Tekrar gönderimdeki mail adersi
//            $mail->AddReplyTo=($_POST["mailiniz"]);//"admin@localhost";//Tekrar gönderimdeki mail adersi
            $mail->FromName = $_POST["ad"];//"PHP Mailer";//gönderenin ismi
            $mail->Host = "ni-luna.guzelhosting.com";//"localhost"; //SMTP server adresi
            $mail->SMTPAuth = true; //SMTP server'a kullanici adi ile baglanilcagini belirtiyoruz
            $mail->SMTPSecure = false;
            $mail->SMTPAutoTLS = false;
            $mail->Port = 587; //Natro SMPT Mail Portu
            $mail->CharSet = 'UTF-8'; //Türkçe yazı karakterleri için CharSet  ayarını bu şekilde yapıyoruz.
            $mail->Username = "yzcenik@yusufziyaattincenik.com";//"admin@localhost"; //SMTP kullanici adi
            $mail->Password = "4164Yzcenik";//""; //SMTP mailinizin sifresi
            $mail->WordWrap = 50;
            $mail->IsHTML(true); //Mailimizin HTML formatinda hazirlanacagini bildiriyoruz.
            $mail->Subject = $_POST["konu"] . " /PHP SMTP Ayarları/Mail Konusu";//"Deneme Maili"; // Mailin Konusu Konu
//Mailimizin gövdesi: (HTML ile)
            $body = "						" . "Mail İçeriği Başlığı" . "<br><br>";
            $body .= "Gönderen Adi		: " . $_POST["ad"] . "<br>";
            $body .= "E-posta Adresi	: " . $_POST["email"] . "<br>";
            $body .= "Konu&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: " . $_POST["konu"] . "<br>";
            $body .= "Mesaj&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: " . $_POST["mesaj"] . "<br>";


            //  $body = $_POST["mesaj"];//"Bu mail bir deneme mailidir. SMTP server ile gönderilmistir.";
            // HTML okuyamayan mail okuyucularda görünecek düz metin:
            $textBody = $body;//"Bu mail bir deneme mailidir. SMTP server ile gönderilmistir.";
            $mail->Body = $body;
            if ($mail->Send()) echo "<div class='alert alert-danger'>HATA,Mesajınız Gönderilmedi</div>";
            else echo "<div class='alert alert-success'>Mesajınız iletildi...</div>";
            $mail->ClearAddresses();
            $mail->ClearAttachments();
//            $mail->AddAttachment('images.png'); //mail içinde resim göndermek için
//            $mail->addCC('mailadi@alanadiniz.site');// cc email adresi
//            $mail->addBCC('mailadi@alanadiniz.site');// bcc email adresi
            $mail->AddAddress("yzcenik@yusufziyaattincenik.com"); // Mail gönderilecek adresleri ekliyoruz.
//            $mail->AddAddress("mailadi@alanadiniz.site"); // Mail gönderilecek adresleri ekliyoruz. Birden fazla ekleme yapılabilir.
            $mail->Send();
            $mail->ClearAddresses();
            $mail->ClearAttachments();
        } ?>
        <div class="container">
            <div class="section-title">
                <h2>İletişim</h2>
            </div>
 
            <div class="row" data-aos="fade-in">
                <div class="col-md-12 d-flex align-items-stretch">
                    <form action="index.html#iletisim" method="POST" id="contact_form" class="col-md-9 content_form">
                        <div class="form-group">
                            <label for="ad">Ad-Soyad:</label>
                            <input type="text" class="form-control" id="ad" name="ad" required="required">
                        </div>
                        <div class="form-group">
                            <label for="email">E-posta Adresi:</label>
                            <input type="email" class="form-control" id="email" name="email" required="required">
                        </div>
                        <div class="form-group">
                            <label for="konu">Konu:</label>
                            <input type="text" class="form-control" id="konu" name="konu" required="required">
                        </div>
                        <div class="form-group">
                            <label for="mesaj">Mesaj:</label>
                            <textarea class="form-control" id="mesaj" name="mesaj"
                                      placeholder="Lütfen mesajınızı giriniz" required="required"></textarea>
                        </div>
                        <button type="submit" style="background-color: #a5172b;color:white"
                                class="btn btn-default col-md-12">Gönder
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->
<?php include "includes/footer.php"; ?>
