<?php
session_start();

class DBController
{
    private $conn;

    function __construct()
    {
        if (!isset($_SESSION["username"])) {
            header("location: http://" . $_SERVER['SERVER_NAME'] . "/admin/index.php");
            exit;
        }
       $dsn = 'mysql:dbname=mahiyecom_yzc;host=45.84.188.3;charset=utf8';
        $user = 'mahiyecom_yzcuser';
        $password = 'Yaman*.123';

        try {
            $dbh = new PDO($dsn, $user, $password);
            $this->conn = $dbh;
        } catch (PDOException $e) {
            echo 'Bağlantı kurulamadı: ' . $e->getMessage();
        }
    }

    function hakkimdabul($tur)
    {
        $sth = $this->conn->prepare("SELECT * FROM hakkimda WHERE tur = ?");
        $sth->execute([$tur]);
        $result = $sth->fetch();
        return $result;
    }

    function hakkimdaguncelle($metin, $tur)
    {
        $sth = $this->conn->prepare("UPDATE hakkimda SET hakkimda=? WHERE tur =?");
        $flag = $sth->execute([$metin, $tur]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function anilar()
    {
        $sth = $this->conn->prepare("SELECT * FROM anilar ORDER BY sira ASC");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    function anisil($id)
    {
        $sth = $this->conn->prepare("DELETE FROM anilar WHERE id =?");
        $flag = $sth->execute([$id]);
        if ($flag) {
            if (file_exists('../../documents/anilar/' . $id)) {
                foreach (glob("../../documents/anilar/" . $id . "/*.*") as $file) {
                    unlink($file);
                }
                rmdir('../../documents/anilar/' . $id);
            }
            return true;
        } else {
            return false;
        }
    }

    function anipasif($id)
    {
        $sth = $this->conn->prepare("UPDATE anilar SET act = 0 WHERE id =?");
        $flag = $sth->execute([$id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function aniaktif($id)
    {
        $sth = $this->conn->prepare("UPDATE anilar SET act = 1 WHERE id =?");
        $flag = $sth->execute([$id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function anibul($id)
    {
        $sth = $this->conn->prepare("SELECT * FROM anilar WHERE id = ?");
        $sth->execute([$id]);
        $result = $sth->fetch();
        return $result;
    }

    function aniguncelle($id, $baslik, $ani, $kapak)
    {
        $sth = $this->conn->prepare("UPDATE anilar SET baslik=?,ani=?,kapak=? WHERE id=?");
        $flag = $sth->execute([$baslik, $ani, $kapak, $id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function aniekle($baslik, $ani, $act, $kapak,$sira)
    {
        $sth = $this->conn->prepare("INSERT INTO anilar
		(`baslik`,`ani`,`act`,`kapak`,`sira`)
		VALUES (?,?,?,?,?)");
        $flag = $sth->execute([$baslik, $ani, $act, $kapak,$sira]);
        if ($flag) {
            $id = $this->conn->lastInsertId();
        } else {
            $id = false;
        }
        return $id;
    }

    function anisirabul()
    {
        $sth = $this->conn->prepare("SELECT MAX(sira) as sira FROM anilar");
        $sth->execute();
        $result = $sth->fetch();
        return $result;
    }

    function anisiraguncelle($sira, $id)
    {
        $sth = $this->conn->prepare("UPDATE anilar SET sira=? WHERE id =?");
        $flag = $sth->execute([$sira, $id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function sil($url)
    {
        if (unlink("../" . $url)) {
            return "Başarıyla Silindi";
        } else {
            return "Başarısız";
        }
    }


    function albumler()
    {
        $sth = $this->conn->prepare("SELECT * FROM albumler ORDER BY sira ASC");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    function albumpasif($id)
    {
        $sth = $this->conn->prepare("UPDATE albumler SET act = 0 WHERE id =?");
        $flag = $sth->execute([$id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function albumaktif($id)
    {
        $sth = $this->conn->prepare("UPDATE albumler SET act = 1 WHERE id =?");
        $flag = $sth->execute([$id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function albumsil($id)
    {
        $sth = $this->conn->prepare("DELETE FROM albumler WHERE id =?");
        $flag = $sth->execute([$id]);
        if ($flag) {
            if (file_exists('../../documents/albumler/' . $id)) {
                foreach (glob("../../documents/albumler/" . $id . "/*.*") as $file) {
                    unlink($file);
                }
                rmdir('../../documents/albumler/' . $id);
            }
            return true;
        } else {
            return false;
        }
    }

    function albumbul($id)
    {
        $sth = $this->conn->prepare("SELECT * FROM albumler WHERE id = ?");
        $sth->execute([$id]);
        $result = $sth->fetch();
        return $result;
    }

    function albumguncelle($baslik, $kapak, $tarih, $id)
    {
        $sth = $this->conn->prepare("UPDATE albumler SET baslik=?,kapak=?,tarih=? WHERE id=?");
        $flag = $sth->execute([$baslik, $kapak, $tarih, $id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function albumekle($baslik, $kapak, $tarih, $act,$sira)
    {
        $sth = $this->conn->prepare("INSERT INTO albumler
		(`baslik`,`kapak`,`tarih`,`act`,`sira`)
		VALUES (?,?,?,?,?)");
        $flag = $sth->execute([$baslik, $kapak, $tarih, $act,$sira]);
        if ($flag) {
            $id = $this->conn->lastInsertId();
        } else {
            $id = false;
        }
        return $id;
    }

    function albumsirabul()
    {
        $sth = $this->conn->prepare("SELECT MAX(sira) as sira FROM albumler");
        $sth->execute();
        $result = $sth->fetch();
        return $result;
    }

    function albumsiraguncelle($sira, $id)
    {
        $sth = $this->conn->prepare("UPDATE albumler SET sira=? WHERE id =?");
        $flag = $sth->execute([$sira, $id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function yazilar()
    {
        $sth = $this->conn->prepare("SELECT * FROM yazilar ORDER BY sira ASC");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    function yazisil($id)
    {
        $sth = $this->conn->prepare("DELETE FROM yazilar WHERE id =?");
        $flag = $sth->execute([$id]);
        if ($flag) {
            if (file_exists('../../documents/yazilar/' . $id)) {
                foreach (glob("../../documents/yazilar/" . $id . "/*.*") as $file) {
                    unlink($file);
                }
                rmdir('../../documents/yazilar/' . $id);
            }
            return true;
        } else {
            return false;
        }
    }

    function yazipasif($id)
    {
        $sth = $this->conn->prepare("UPDATE yazilar SET act = 0 WHERE id =?");
        $flag = $sth->execute([$id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function yaziaktif($id)
    {
        $sth = $this->conn->prepare("UPDATE yazilar SET act = 1 WHERE id =?");
        $flag = $sth->execute([$id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function yazibul($id)
    {
        $sth = $this->conn->prepare("SELECT * FROM yazilar WHERE id = ?");
        $sth->execute([$id]);
        $result = $sth->fetch();
        return $result;
    }

    function yaziguncelle($id, $baslik, $ani, $kapak)
    {
        $sth = $this->conn->prepare("UPDATE yazilar SET baslik=?,yazi=?,kapak=? WHERE id=?");
        $flag = $sth->execute([$baslik, $ani, $kapak, $id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }


    function yaziekle($baslik, $yazi, $act, $kapak,$sira)
    {
        $sth = $this->conn->prepare("INSERT INTO yazilar
		(`baslik`,`yazi`,`act`,`kapak`,`sira`)
		VALUES (?,?,?,?,?)");
        $flag = $sth->execute([$baslik, $yazi, $act, $kapak,$sira]);
        if ($flag) {
            $id = $this->conn->lastInsertId();
        } else {
            $id = false;
        }
        return $id;
    }

    function yazisirabul()
    {
        $sth = $this->conn->prepare("SELECT MAX(sira) as sira FROM yazilar");
        $sth->execute();
        $result = $sth->fetch();
        return $result;
    }

    function yazisiraguncelle($sira, $id)
    {
        $sth = $this->conn->prepare("UPDATE yazilar SET sira=? WHERE id =?");
        $flag = $sth->execute([$sira, $id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function changepassword($username, $password)
    {
        $password = sha1(md5($password));
        $sth = $this->conn->prepare("UPDATE users SET password =? WHERE username =?");
        $flag = $sth->execute([$password, $username]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }
}


?>