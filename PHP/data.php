<?php
session_start();
if(!isset($_SESSION["logged_in"])) {
    header("Location: index.php");
    die();
}

include_once("DBController.php");

$db = new DBController();

if(isset($_POST["delete_data"])) {
    $sanitizedDeletionId = filter_var($_POST["deletion_id"], FILTER_SANITIZE_SPECIAL_CHARS);
    $db->deleteData($sanitizedDeletionId);
}
ParameterListScreen::displayScreen($db);

/**
* Klasa zawierająca kod html ekranu listy parametrów oraz listy wszystkich nagrań w bazie danych
*/
class ParameterListScreen
{
/**
* Metoda służąca do wyświetlenia ekranu listy parametrów oraz listy wszystkich nagrań w bazie danych.
*
* @param $db odwołanie do obiektu klasy SBController
* @see DBController
*/
    public static function displayScreen($db){
        echo'
            <html>
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
                <title>Parametry - Parametryzacja głosu</title>
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

        if($_SESSION["user_role"] !== "Gość"){
             echo '<li class="nav-item" role="presentation"><a class="nav-link" href="add.php">Dodaj nagranie</a></li>'; 
		}
        echo'
                        <li class="nav-item" role="presentation"><a class="nav-link" href="data.php">Tabela parametrów</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="logout.php">Wyloguj się</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th colspan="2">Opisy parametrów</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>CPP</td>
                        <td>Cepstral Peak Prominence<br></td>
                    </tr>
                    <tr>
                        <td>H1H2</td>
                        <td>The ratio of the first harmonic energy F0 (H1) to the second harmonic energy (H2)<br></td>
                    </tr>
                    <tr>
                        <td>HRF</td>
                        <td>Harmonic Richness Factor<br></td>
                    </tr>
                    <tr>
                        <td>NAQ</td>
                        <td>Normalized Amplitude Quotient<br></td>
                    </tr>
                    <tr>
                        <td>PSP</td>
                        <td>Parabolic Spectral Parameter<br></td>
                    </tr>
                    <tr>
                        <td>QOQ</td>
                        <td>Quasi Open Quotient<br></td>
                    </tr>
                    <tr>
                        <td>MDQ</td>
                        <td>Maxima Dispersion Quotient<br></td>
                    </tr>
                    <tr>
                        <td>PS</td>
                        <td>Peak Slope<br></td>
                    </tr>
                    <tr>
                        <td>RDS</td>
                        <td>Rd shape parameter of Liljencrants-Fant glottal model 1<br></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nagranie</th>
                        <th>CPP</th>
                        <th>H1H2</th>
                        <th>HRF</th>
                        <th>NAQ</th>
                        <th>PSP</th>
                        <th>QOQ</th>
                        <th>MDQ</th>
                        <th>PS</th>
                        <th>RDS</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>';
        $paramRows = $db->readData();
        foreach($paramRows as $row){
            echo '
                    <tr>
                        <th>'.$row["pacjent_ID"].'</th>
                        <td>'.$row["CPP"].'</td>
                        <td>'.$row["H1H2"].'</td>
                        <td>'.$row["HRF"].'</td>
                        <td>'.$row["NAQ"].'</td>
                        <td>'.$row["PSP"].'</td>
                        <td>'.$row["QOQ"].'</td>
                        <td>'.$row["MDQ"].'</td>
                        <td>'.$row["PS"].'</td>
                        <td>'.$row["RDS"].'</td>
                        <td><a href="details.php?id='.$row["pacjent_ID"].'">Szczegóły</a></td>
                    </tr>';
		}
        echo'
        </tbody>
            </table>
        </div>
        <p class="text-center"><a href="export.php">Eksportuj dane do CSV</a></p>
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
<?php
$paramRows = null;
$db = null;
?>
</html>';
    }
}


?>

<!DOCTYPE html>



                   
                    
                    

                