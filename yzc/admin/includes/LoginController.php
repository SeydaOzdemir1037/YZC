<?php

class LoginController{
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
    function check($username,$password){
        $error="";
        $password = sha1(md5($password));
        $sql = "SELECT * FROM users WHERE username = :username AND password = :password";

        if($stmt =  $this->conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $password, PDO::PARAM_STR);

            if($stmt->execute()){
                // Check if username exists, if yes then verify password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["id"];
                        $username = $row["username"];
                        session_start();
                        $_SESSION["giris"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["username"] = $username;
                        header("location: index2.php");
                    }
                    else{
                        $error = "Sistem Hatası.";
                    }
                }
                else{
                    $error = "Kullanıcı Adı veya Şifre Yanlıştır.";
                }
            } else{
                $error = "Sistem Hatası.";
            }
        }
        else{
            $error = "Sistem Hatası.";
        }
        unset($stmt);
        unset($dbh);
        unset($this->conn);
        return $error;
    }
}
?>