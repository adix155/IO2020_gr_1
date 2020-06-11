<?php
session_start();
if(!isset($_SESSION["logged_in"])) {
    header("Location: index.php");
    die();
}

AddingScreen::displayScreen();
/**
* Klasa zawierająca kod html ekranu dodawania nowego nagrania.
*/
class AddingScreen{
/**
* Metoda służąca do wyświetlenia ekranu dodawania nowego nagrania, wraz z walidacją wprowadzanych danych.
*
*/
    public static function displayScreen(){
        echo'
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
    <script type="text/javascript">
    function sprawdz()
    {
        var x = 0;
        if (document.getElementById("name").value == "")
        {
        document.getElementById("alert1").innerHTML="Wpisz swoje imię i nazwisko";
        x=1;
        }else{
        if(/^[a-ząęńłóżźśćA-ZĄĘŃŁÓŚĆŻŹ\s\-]*$/.test(document.getElementById("name").value))
        {
        if(/[A-ZĄĘŃŁÓŚĆŻŹ][A-ZĄĘŃŁÓŚĆŻŹ]/.test(document.getElementById("name").value) || /[a-ząęńłóżźść][A-ZĄĘŃŁÓŚĆŻŹ]/.test(document.getElementById("name").value))
        {
        document.getElementById("alert1").innerHTML="Niewłaściwe imię i nazwisko";
        x=1;
        }
        else
        {
        if(/\s/.test(document.getElementById("name").value))
        {
        if(/^[A-ZĄĘŃŁÓŚĆŻŹ][a-ząęńłóżźśćA-ZĄĘŃŁÓŚĆŻŹ\s\-]*$/.test(document.getElementById("name").value))
        {
        if(/[\s][A-ZĄĘŃŁÓŚĆŻŹ]/.test(document.getElementById("name").value))
        {
        if(/[\-][a-ząęńłóżźść]/.test(document.getElementById("name").value))
        {
        document.getElementById("alert1").innerHTML="Niewłaściwe imię i nazwisko";
        x=1;
        }
        else
        {
        if(/[A-ZĄĘŃŁÓŚĆŻŹ][a-ząęńłóżźść]/.test(document.getElementById("name").value))
        {
        document.getElementById("alert1").innerHTML=null;
        }
        else
        {
        document.getElementById("alert1").innerHTML="Niewłaściwe imię i nazwisko";
        x=1;
        }
        }
        }
        else
        {
        document.getElementById("alert1").innerHTML="Niewłaściwe imię i nazwisko";
        x=1;
        }
        }
        else
        {
        document.getElementById("alert1").innerHTML="Niewłaściwe imię i nazwisko";
        x=1;
        }
        }
        else
        {
        document.getElementById("alert1").innerHTML="Niewłaściwe imię i nazwisko";
        x=1;
        }
        }
        }
        else{
        document.getElementById("alert1").innerHTML="Niewłaściwe imię i nazwisko";
        x=1;
        }
        }

        if (document.getElementById("age").value == "")
        {
        document.getElementById("alert2").innerHTML="Wpisz swój wiek";
        x=1;
        }else{
        document.getElementById("alert2").innerHTML=null;
        }

        if(document.getElementsByName("plec")[0].checked == false && document.getElementsByName("plec")[1].checked == false)
        {
        document.getElementById("alert3").innerHTML="Zaznacz swoją płeć";
        x=1;
        }else{
        document.getElementById("alert3").innerHTML=null;
        }

        if (document.getElementById("RBH").value == "")
        {
        document.getElementById("alert4").innerHTML="Wpisz RBH";
        x=1;
        }else {
        if (/^[0-9]*$/.test(document.getElementById("RBH").value) && document.getElementById("RBH").value.length==3)
        {
        document.getElementById("alert4").innerHTML=null;
        }
        else
        {
        document.getElementById("alert4").innerHTML="Niewłaściwe RBH";
        x=1;
        }
        }

        


        if (x==0) return true;
        else return false;
    }
    </script>
    <style>
    #alert1, #alert2, #alert3, #alert4
    {
    font-weight: bold;
    color: #b50101;
    }
    </style>
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
        <form action="parameters.php" enctype="multipart/form-data" method="POST" onsubmit="return sprawdz()">
            <h2 class="text-center">Dodaj nagranie</h2>
            <div class="form-group"><input class="form-control" type="text" name="name" placeholder="Imię i nazwisko"></div><div id="alert1"></div>
            <div class="form-group"><input class="form-control" type="number" name="age" placeholder="Wiek" step="1" min="1"></div><div id="alert2"></div>
            <div class="form-group">
                <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="plec" value="Kobieta"><label class="form-check-label" for="formCheck-1">Kobieta</label></div>
                <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="plec" value="Mężczyzna"><label class="form-check-label" for="formCheck-2">Mężczyzna</label></div><div id="alert3"></div>
            </div>
            <div class="form-group"><input class="form-control" type="text" name="RBH" placeholder="Skala RBH"></div><div id="alert4"></div>
            <div class="form-group"><input type="file" name="recording" accept="audio/*"></div>
            <input type="hidden" name="MAX_FILE_SIZE" value="512000" />
            <div class="form-group"><button class="btn btn-info" role="button" type="submit">Dodaj</button><a class="btn btn-light" role="button" style="margin-left: 10px;" href="data.php">Wróć</a></div>
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
        ';
    }
}
?>

