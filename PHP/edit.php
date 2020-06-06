<?php
session_start();
if(!isset($_SESSION["logged_in"])) {
    header("Location: index.php");
    die();
}

if(!isset($_GET["id"])) {
    header("Location: data.php");
    die();
}

include_once("DBController.php");

$sanitizedID = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);
$db = new DBController();
$rowData = $db->readOne($sanitizedID);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Edytuj dane dla nagrania #<?=$rowData["pacjent_ID"];?> - Parametryzacja głosu</title>
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
        <div class="container"><a class="navbar-brand" href="#">Parametryzacja głosu</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse"
                id="navcol-1">
                <ul class="nav navbar-nav ml-auto">
                    <?php if ($_SESSION["user_role"] !== "Gość"):?>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="add.php">Dodaj nagranie</a></li>
                    <?php endif;?>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="data.php">Tabela parametrów</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="logout.php">Wyloguj się</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="contact-clean">
        <form method="post" action="details.php?id=<?=$rowData["pacjent_ID"];?>">
            <h2 class="text-center">Edytuj dane</h2>
            <?php if ($_SESSION["user_role"] === "Uprawniony"):?>
            <div class="form-group"><input class="form-control" type="text" name="patient_data" placeholder="Imię i nazwisko" value="<?=trim($rowData["imie"] . " " . $rowData["nazwisko"]);?>"></div>
            <?php endif;?>
            <div class="form-group"><input class="form-control" type="text" name="RBH" placeholder="RBH" value=<?=$rowData["RBH"];?>></div>
            <div class="form-group"><button class="btn btn-info" type="submit" name="save_changes" role="button">Zapisz</button><a class="btn btn-light" role="button" style="margin-left: 10px;" href="details.php?id=<?=$rowData["pacjent_ID"];?>">Wróć</a></div>
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
