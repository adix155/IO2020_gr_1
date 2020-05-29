<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dodaj nagranie - Parametryzacja głosu</title>
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
                    <li class="nav-item" role="presentation"><a class="nav-link" href="add.php">Dodaj nagranie</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="data.php">Tabela parametrów</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="logout.php">Wyloguj się</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="contact-clean">
        <form method="post">
            <h2 class="text-center">Dodaj nagranie</h2>
            <div class="form-group"><input class="form-control" type="text" name="name" placeholder="Imię i nazwisko"></div>
            <div class="form-group"><input class="form-control" type="number" placeholder="Wiek" step="1" min="1"></div>
            <div class="form-group">
                <div class="form-check form-check-inline"><input class="form-check-input" type="radio" id="formCheck-1" name="plec"><label class="form-check-label" for="formCheck-1">Kobieta</label></div>
                <div class="form-check form-check-inline"><input class="form-check-input" type="radio" id="formCheck-2" name="plec"><label class="form-check-label" for="formCheck-2">Mężczyzna</label></div>
            </div>
            <div class="form-group"><input class="form-control" type="text" name="name" placeholder="Skala RBH"></div>
            <div class="form-group"><input type="file" accept="audio/*"></div>
            <div class="form-group"><a class="btn btn-info" role="button" href="data.php">Dodaj</a><a class="btn btn-light" role="button" style="margin-left: 10px;" href="data.php">Wróć</a></div>
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