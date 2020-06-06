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

if(isset($_POST["save_changes"])) {
    $sanitizedPatientData = filter_var($_POST["patient_data"], FILTER_SANITIZE_SPECIAL_CHARS);
    $sanitizedRBH = filter_var($_POST["RBH"], FILTER_SANITIZE_SPECIAL_CHARS);
    $db->editData($sanitizedPatientData, $sanitizedRBH, $sanitizedID);
}

if(isset($_POST["delete_data"])) {

}

$rowData = $db->readOne($sanitizedID);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Szczegóły dla nagrania #<?=$rowData["pacjent_ID"];?> - Parametryzacja głosu</title>
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
    <div class="modal fade" role="dialog" tabindex="-1" id="modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Potwierdź usunięcie</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                <div class="modal-body">
                    <p>Czy na pewno chcesz usunąć rekord?</p>
                </div>
                <form method="post" action="data.php"><div class="modal-footer"><input type="hidden" name="deletion_id" value="<?=$rowData["pacjent_ID"];?>"><button class="btn btn-light" type="button" data-dismiss="modal">Anuluj</button><button class="btn btn-danger" type="submit" name="delete_data" role="button">Usuń</a></div></form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th colspan="2">Szczegóły dla nagrania numer <?=$rowData["pacjent_ID"];?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($_SESSION["user_role"] === "Uprawniony"):?>
                    <tr>
                        <td>Imię i nazwisko</td>
                        <td><?=$rowData["imie"] . " " . $rowData["nazwisko"];?></td>
                    </tr>
                    <?php endif;?>
                    <tr>
                        <td>Płeć</td>
                        <td><?=$rowData["plec"];?></td>
                    </tr>
                    <tr>
                        <td>Wiek</td>
                        <td><?=$rowData["wiek"];?></td>
                    </tr>
                    <tr>
                        <td>CPP</td>
                        <td><?=$rowData["CPP"];?></td>
                    </tr>
                    <tr>
                        <td>H1H2</td>
                        <td><?=$rowData["H1H2"];?></td>
                    </tr>
                    <tr>
                        <td>HRF</td>
                        <td><?=$rowData["HRF"];?></td>
                    </tr>
                    <tr>
                        <td>NAQ</td>
                        <td><?=$rowData["NAQ"];?></td>
                    </tr>
                    <tr>
                        <td>PSP</td>
                        <td><?=$rowData["PSP"];?></td>
                    </tr>
                    <tr>
                        <td>QOQ</td>
                        <td><?=$rowData["QOQ"];?></td>
                    </tr>
                    <tr>
                        <td>MDQ</td>
                        <td><?=$rowData["MDQ"];?></td>
                    </tr>
                    <tr>
                        <td>PS</td>
                        <td><?=$rowData["PS"];?></td>
                    </tr>
                    <tr>
                        <td>RDS</td>
                        <td><?=$rowData["RDS"];?></td>
                    </tr>
                    <tr>
                        <td>Skala RBH</td>
                        <td><?=$rowData["RBH"];?></td>
                    </tr>
                    <tr>
                        <td>Plik z nagraniem</td>
                        <td><a href="./octave/recordings/rec_<?=$rowData["pacjent_ID"];?>.wav" download>Pobierz</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <header></header>
    </div>
    <?php if($_SESSION["user_role"] === "Uprawniony"): ?>
    <p class="text-center"><a href="edit.php?id=<?=$rowData["pacjent_ID"];?>">Edytuj dane osobowe i skalę RBH</a></p>
    <p class="text-center"><a id="modal-popup" href="#">Usuń wpis</a></p>
    <?php endif;?>
    <hr>
    <div class="container"><img width="100%" src="./octave/plots/amplitude_<?=$rowData["pacjent_ID"];?>.jpg"></div>
    <div class="footer-dark">
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col text-center"><img src="assets/img/seal.png" style="width: 150px;"></div>
                </div>
                <p class="copyright">Aplikacja do parametryzacji głosu<br>stworzona przez studentów drugiego roku kierunku Informatyka<br>Wydziału Zastosowań Matematyki i Informatyki<br>Szkoły Głównej Gospodarstwa Wiejskiego w Warszawie<br>w ramach przedmiotu Inżynieria Oprogramowania</p>
                <p class="copyright">SGGW © 2020</p>
            </div>
        </footer>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/modal.js"></script>
</body>

</html>