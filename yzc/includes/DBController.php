<?php
session_start();

class DBController{
    private $conn;
    function __construct() {
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

    function hakkimda(){
        $sth = $this->conn->prepare("SELECT * FROM hakkimda WHERE tur='hakkimda'");
        $sth->execute();
        $result = $sth->fetch();
        return $result;
    }

    function anilar($kacadet){
        $sql="SELECT * FROM anilar WHERE act=1 ORDER BY sira ASC ";

        if($kacadet !=''){
            $sql=$sql."LIMIT 0, :buraya";
        }
        $sth=$this->conn->prepare($sql);
        if($kacadet !=''){
            $sth->bindParam(':buraya', $kacadet, PDO::PARAM_INT);
        }
        $sth->execute();
        $result=$sth->fetchAll();
        return $result;
    }

    function albumler($kacadet){
        $sql="SELECT * FROM albumler WHERE act=1 ORDER BY sira ASC ";

        if($kacadet !=""){
            $sql=$sql."LIMIT 0, :buraya";
        }
        $sth=$this->conn->prepare($sql);
        if($kacadet !=""){
            $sth->bindParam(':buraya', $kacadet, PDO::PARAM_INT);
        }
        $sth->execute();
        $result=$sth->fetchAll();
        return $result;
    }

    function yazilar($kacadet){
        $sql="SELECT * FROM yazilar WHERE act=1 ORDER BY sira ASC ";

        if($kacadet !=""){
            $sql=$sql."LIMIT 0, :buraya";
        }
        $sth=$this->conn->prepare($sql);
        if($kacadet !=""){
            $sth->bindParam(':buraya', $kacadet, PDO::PARAM_INT);
        }
        $sth->execute();
        $result=$sth->fetchAll();
        return $result;
    }

    function anibul($id){
        $sth = $this->conn->prepare("SELECT * FROM anilar WHERE id = ? AND act = 1");
        $sth->execute([$id]);
        $result = $sth->fetch();
        return $result;
    }

    function albumbul($id){
        $sth = $this->conn->prepare("SELECT * FROM albumler WHERE id = ? AND act = 1");
        $sth->execute([$id]);
        $result = $sth->fetch();
        return $result;
    }

    function yazibul($id){
        $sth = $this->conn->prepare("SELECT * FROM yazilar WHERE id = ? AND act = 1");
        $sth->execute([$id]);
        $result = $sth->fetch();
        return $result;
    }

}
?>