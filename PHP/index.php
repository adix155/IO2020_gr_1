<?php
session_start();
if(isset($_SESSION["logged_in"])) {
    header("Location: data.php");
    die();
}

$error = false;
$errorMessage = "";

if(isset($_SESSION["invalid_password"]) && $_SESSION["invalid_password"] === true) {
    $error = true;
    $errorMessage = "Wprowadzono nieprawidłowe hasło!";
    $_SESSION["invalid_password"] = null;
}

if(isset($_SESSION["user_doesnt_exist"]) && $_SESSION["user_doesnt_exist"] === true) {
    $error = true;
    $errorMessage = "Użytkownik o podanej nazwie nie istnieje! Sprawdź pisownię.";
    $_SESSION["user_doesnt_exist"] = null;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Logowanie - Parametryzacja głosu</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Contact-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Footer-Dark.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-md bg-dark navigation-clean">
        <div class="container"><a class="navbar-brand" href="#">Parametryzacja głosu</a></div>
    </nav>
    <div class="login-dark" style="background-image: url(&quot;assets/img/1580056.jpg&quot;);height: 700px;background-size: cover;background-repeat: no-repeat;background-position: center;">
        <div class="container" style="display:<?=$error === true ? "initial" : "none";?>;">
            <div class="alert alert-danger" style="width:98%;margin:0 auto;z-index:1000" role="alert">
                <?=$errorMessage != null ? $errorMessage : "";?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
        </div>
        <form method="post" action="login.php">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="form-group"><input class="form-control" type="text" name="username" placeholder="Login"></div>
            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Hasło"></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit" role="button">Zaloguj się</button><button class="btn btn-primary btn-block" type="submit" role="button" name="guest" style="background-color: rgb(100,125,157);">Zaloguj jako gość</button></div>
        </form>
    </div>
    <div class="footer-dark">
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col text-center"><img src="assets/img/seal.png" style="width: 150px;"></div>
                </div>
                <p class="copyright">Aplikacja do parametryzacji głosu&nbsp;<br>stworzona przez studentów drugiego roku kierunku Informatyka&nbsp;<br>Wydziału Zastosowań Informatyki i Matematyki&nbsp;<br>Szkoły Głównej Gospodarstwa Wiejskiego w Warszawie&nbsp;<br>w ramach
                    przedmiotu Inżynieria Oprogramowania<br></p>
                <p class="copyright">SGGW © 2020</p>
            </div>
        </footer>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/modal.js"></script>
</body>

</html>