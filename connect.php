<?php
declare(strict_types=1);
session_start();
class Login {
    //connection database
    public function db(){
        try{
            $cnx = new PDO('mysql:host=127.0.0.1;dbname=login','root', '');
        }catch (PDOException $e) {
            echo "¡Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        return $cnx;
    }
    public function add($name, $lastname,$email,$password,$conectDB){
        $user = $this->validateUser($email, $conectDB);
        if($user === false){
            $nameV = $this-> validationStr($name);
            $lastnameV = $this-> validationStr($lastname);
            $passwordV = $this-> validatePassword($password);
    
            if($nameV === false || $lastnameV === false){
                $_SESSION["messageNamesError"] = 'Oops, you have an error in your name or surname verify that everything is fine';
                $_SESSION["vandera"] = 2;
                header('location: create_account.php');
            }else{
                $datos = [$name, $lastname, $email];
            }
            if($passwordV === false){
                $_SESSION["messagePasswordError"] = 'Your password is invalid, it must contain at least 8 characters and at least one numeric character';
                $_SESSION["vandera"] = 3;
                header('location: create_account.php');
            }else{
                $passwordHas = password_hash($password, PASSWORD_DEFAULT);
                $datos[] = $passwordHas;
                $sent = $conectDB->prepare("INSERT INTO login (name, lastname, email,password) VALUES(?,?,?,?)");
                $sent->execute($datos);
                $_SESSION["vandera"] = 4;
                $_SESSION["operationSuccesfully"] = 'Your user is successfully registered!';
                header('location: create_account.php');
                $sent = NULL;
                $conectDB = NULL;
            }
        }else{
            $_SESSION["DuplicateUser"] = 'this user is already registered';
            $_SESSION["vandera"] = 8;
            header('location: create_account.php');
        }
    }
    //validation for name and lastname
    public function validationStr(string $str): bool {
        if(preg_match_all('/^[a-z]{3,20}+$/i', $str, $match)){
            return true;
        }else{
            return false;
        }
    }
    //validation for password
    public function validatePassword(string $pass): bool {
        if(preg_match_all('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,}$/', $pass, $match)){
            return true;
        }else{
            return false;
        }
    }
    public function log($email, $password, $conectDB){
        $sent = $conectDB->prepare("SELECT * FROM login WHERE email = ?");
        $sent->execute(array($email));
        $result = $sent->fetchAll();
        if(empty($result)){
            $_SESSION["errorLogin"] = 'Oops, you are not registered';
            $_SESSION["vandera"] = 6;
            header('location: index.php');
        }else{
            $verify = password_verify($password, $result[0][4]);
            if($verify === false){
                $_SESSION["errorPassword"] = 'Your password is incorrect, try again';
                $_SESSION["vandera"] = 7;
                header('location: index.php');
            }else{
                $_SESSION["user"] = $result[0][1] . ' '.  $result[0][2];
                $_SESSION["type"] = 'user';
                header('location: home.php');
            }
        }
        $sent = NULL;
        $conectDB = NULL;
    }
    public function validateUser($email, $conectDB){
        $sent = $conectDB->prepare("SELECT * FROM login WHERE email = ?");
        $sent->execute(array($email));
        $result = $sent->fetch();
        $sent = NULL;
        $conectDB = NULL;
        return $result;
    }
}
//connect
$connect = new Login();
$conectDB = $connect->db();
//add
if(isset($_POST['name']) || isset($_POST['lastname']) || $_POST["password"] || $_POST['email']){
    if(trim($_POST['name']) == '' || trim($_POST['lastname']) == '' || trim($_POST["password"]) == '' || trim($_POST['email']) ==  ''){
        $_SESSION["messageError"] = 'Remember to fill in all fields';
        $_SESSION["vandera"] = 1;
        header('location: create_account.php');
    }else{
        $connect->add($_POST["name"], $_POST["lastname"], $_POST["email"], $_POST["password"], $conectDB);
    }
}
//Sigin
if(isset($_GET['email']) || $_GET["password"]){
    if(trim($_GET['email']) == '' || trim($_GET['password']) == ''){
        $_SESSION["messageErrorEmpty"] = 'Remember to fill in all fields';
        $_SESSION["vandera"] = 5;
        header('location: index.php');
    }else{
        $connect->log($_GET['email'], $_GET['password'], $conectDB);
    }
}
//logout
if(isset($_GET['log'])){
    if($_GET['log'] == 1){
        session_destroy();
        header('location: index.php');
    }
}