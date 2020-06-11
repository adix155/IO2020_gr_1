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
    DetailsScreen::editData($_POST["patient_data"],$_POST["RBH"],$sanitizedID,$db);
}

if(isset($_POST["delete_data"])) {

}

DetailsScreen::displayScreen($_SESSION["user_role"],$sanitizedID,$db);
/**
* Klasa zawierająca kod html ekranu szczegółów nagrania
*/
class DetailsScreen{

/**
* Metoda pośrednia w edytowaniu pozycji w bazie danych. 
*
* Metoda odpowiednio przygotowuje dane do edycji, zebrane z formularza, a następnie wywołuje funkcję do edycji pozycji w klasie DBController.
*
* @param $data nowe imię i nazwisko pacjenta oddzielone spacją
* @param $rbh nowa skala rbh pacjenta
* @param $id id pacjenta, którego dane mają być edytowane
* @param $db odwołanie do obiektu klasy SBController
* @see DBController
*/
    static function editData($data,$rbh,$id,$db){
    $sanitizedPatientData = filter_var($data, FILTER_SANITIZE_SPECIAL_CHARS);
    $sanitizedRBH = filter_var($rbh, FILTER_SANITIZE_SPECIAL_CHARS);
    $db->editData($sanitizedPatientData, $sanitizedRBH, $sanitizedID);
	}

 /**
* Metoda służąca do wyświetlenia ekranu szczegółów nagrania
*
* @param $userRole poziom dostępu aktualnie zalogowanego użytkownika
* @param $id id pacjenta, którege szczegółowe dane mają zostać wyświetlone
* @param $db odwołanie do obiektu klasy SBController
* @see DBController
*/
    public static function displayScreen($userRole,$id,$db){
    $rowData = $db->readOne($id);

        echo'
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Szczegóły dla nagrania #'.$rowData["pacjent_ID"].' - Parametryzacja głosu</title>
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
                <ul class="nav navbar-nav ml-auto">';
                if($userRole!=="Gość"){
                echo '<li class="nav-item" role="presentation"><a class="nav-link" href="add.php">Dodaj nagranie</a></li>';
				}
        echo'
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
                <form method="post" action="data.php"><div class="modal-footer"><input type="hidden" name="deletion_id" value="'.$rowData["pacjent_ID"].'"><button class="btn btn-light" type="button" data-dismiss="modal">Anuluj</button><button class="btn btn-danger" type="submit" name="delete_data" role="button">Usuń</a></div></form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th colspan="2">Szczegóły dla nagrania numer '.$rowData["pacjent_ID"].'</th>
                    </tr>
                </thead>
                <tbody>';

        if($userRole==="Uprawniony"){
            echo'
                    <tr>
                        <td>Imię i nazwisko</td>
                        <td>'.$rowData["imie"] . " " . $rowData["nazwisko"].'</td>
                    </tr>';
		}
        echo'
                    <tr>
                        <td>Płeć</td>
                        <td>'.$rowData["plec"].'</td>
                    </tr>
                    <tr>
                        <td>Wiek</td>
                        <td>'.$rowData["wiek"].'</td>
                    </tr>
                    <tr>
                        <td>CPP</td>
                        <td>'.$rowData["CPP"].'</td>
                    </tr>
                    <tr>
                        <td>H1H2</td>
                        <td>'.$rowData["H1H2"].'</td>
                    </tr>
                    <tr>
                        <td>HRF</td>
                        <td>'.$rowData["HRF"].'</td>
                    </tr>
                    <tr>
                        <td>NAQ</td>
                        <td>'.$rowData["NAQ"].'</td>
                    </tr>
                    <tr>
                        <td>PSP</td>
                        <td>'.$rowData["PSP"].'</td>
                    </tr>
                    <tr>
                        <td>QOQ</td>
                        <td>'.$rowData["QOQ"].'</td>
                    </tr>
                    <tr>
                        <td>MDQ</td>
                        <td>'.$rowData["MDQ"].'</td>
                    </tr>
                    <tr>
                        <td>PS</td>
                        <td>'.$rowData["PS"].'</td>
                    </tr>
                    <tr>
                        <td>RDS</td>
                        <td>'.$rowData["RDS"].'</td>
                    </tr>
                    <tr>
                        <td>Skala RBH</td>
                        <td>'.$rowData["RBH"].'</td>
                    </tr>
                    <tr>
                        <td>Plik z nagraniem</td>
                        <td><a href="./octave/recordings/rec_'.$rowData["pacjent_ID"].'.wav" download>Pobierz</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <header></header>
    </div>';
    
    if($userRole==="Uprawniony"){
        echo'
        <p class="text-center"><a href="edit.php?id='.$rowData["pacjent_ID"].'">Edytuj dane osobowe i skalę RBH</a></p>
        <p class="text-center"><a id="modal-popup" href="#">Usuń wpis</a></p>';
	}
    echo'
    <hr>
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
    ';
    }

}
?>