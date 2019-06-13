<?php
include "conn.php";
if (isset($_POST['login'])){
    $username = strtolower($_POST['username']);
    $password = $_POST['password'];
    $sql = "SELECT * FROM `admin` WHERE username = '$username'";
    $st = $connection->prepare($sql);
    $st->execute();
    $user = $st->fetch(PDO::FETCH_ASSOC);

    header("Content-Type: text/plain");
    if ($user['username'] == $username) {
        header("Content-Type: text/plain");
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION["username"]=$username;
            $_SESSION["loggedin"]='true';
            header('Location: adminarea.php');
            die();
        } else {
            echo "Your password is incorrect!!!";
            header('refresh:2;url=admin.php');
        }
    } else {
        echo "Your username is incorrect!!!";
        header('refresh:2;url=admin.php');
    }
} else {
    header('Location: admin.php');
    die();
}
?>