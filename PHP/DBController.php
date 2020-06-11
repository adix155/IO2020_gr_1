<?php

/**
* Klasa s³u¿¹ca do ³¹czenia z baz¹ danych.
*
* Klasa zawiera metady do odczytu edycji i zapisu do bazy danych powi¹zanych z nagraniami g³osu, takimi jak imiê, nazwisko czy wiek pacjenta a tak¿e wyliczone parametry.
*/
class DBController {
/**
* Prywatna zmienna przechowuj¹ca dane do po³¹czenia z baz¹ danych tj. adres serwera MySQL, nazwê bazy oraz kodowanie znaków.
*/
    private $connectionString = "mysql:host=localhost;dbname=voiceparametrization;charset=utf8";
/**
* Prywatna zmienna przechowuj¹ca login do MySQL.
*/
    private $dbUsername = "root";
/**
* Prywatna zmienna przechowuj¹ca has³o do MySQL.
*/
    private $dbPassword = "zaq1@WSX";
/**
* Publiczny obiekt klasy PDO, reprezentuj¹cej po³¹czenie PHP z serwerem MySQL.
*/
    public $dbConnection;
/**
* Konstruktor klasy DBController inicjalizuj¹cy po³¹czenie z baz¹ danych.
*/
    function __construct() {
        $this->dbConnection = new PDO($this->connectionString, $this->dbUsername, $this->dbPassword);
    }
/**
* Metoda s³u¿¹ca do odczytu wszystkich danych pacjentów z bazy danych. 
*
* @return tablica wszystkich obiektów w tabeli pacjentów.
*/
    public function readData() {
        $queryString = "SELECT * FROM voiceparametrization.parameters";
        $queryData = $this->dbConnection->prepare($queryString);
        $queryData->execute();
        $result = $queryData->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
/**
* Metoda s³u¿¹ca do dodawania nowej pozycji do tabeli pacjentów z bazy danych. 
*
* Metoda dodaje do tabeli pacjentów now¹ pozycjê, wraz z wszystkimi danymi osobistymi i ju¿ obliczonymi parametrami.
*
* @param $insertArray tablica zawieraj¹ca dane do wpisu w nastêpuj¹cej kolejnoœci: imie , nazwisko , plec , wiek , CPP , H1H2 , HRF , NAQ , PSP , QOQ , MDQ , PS , RDS , RBH , nazwa nagrania
*
*/
    public function addData($insertArray) {
        $queryString = "INSERT INTO voiceparametrization.parameters (imie , nazwisko , plec , wiek , CPP , H1H2 , HRF , NAQ , PSP , QOQ , MDQ , PS , RDS , RBH , recording_name , amplitude_name) VALUES (? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ?)";
        $queryData = $this->dbConnection->prepare($queryString);
        $queryData->execute($insertArray);
        return;
    }
/**
* Metoda s³u¿¹ca do edytowania pozycji w tabeli pacjentów z bazy danych. 
*
* Metoda pozwala edytowaæ imiê, nazwisko oraz skalê rbh pacjenta o podanym id.
*
* @param $patientNameSurname string zawieraj¹cy nowe imiê i nazwisko, rozdzielone spacjami 
* @param $rbhScale string zawieraj¹cy now¹ skala rbh
* @param $patientID id pacjenta, który ma byæ edytowany
*
*/
    public function editData($patientNameSurname, $rbhScale, $patientID) {
        $patientData = explode(" ", $patientNameSurname);
        $patientName = $patientData[0];
        $patientSurname = $patientData[1];
        $queryString = "UPDATE voiceparametrization.parameters SET imie = ? , nazwisko = ? , RBH = ? WHERE pacjent_ID = ?";
        $queryData = $this->dbConnection->prepare($queryString);
        $queryData->execute(array($patientName, $patientSurname, $rbhScale, $patientID));
        return;
    }
/**
* Metoda s³u¿¹ca do usuniêcia pozycji w tabeli pacjentów z bazy danych. 
*
* Metoda pozwala usun¹æ pozycjê pacjenta o podanym id z bazy danych.
*
* @param $patientID id pacjenta, który ma byæ usuniêty
*
*/
    public function deleteData($patientID) {
        $queryString = "DELETE FROM voiceparametrization.parameters WHERE pacjent_ID = ?";
        $queryData = $this->dbConnection->prepare($queryString);
        $queryData->execute(array($patientID));
        return;
    }

/**
* Metoda s³u¿¹ca do odczytu jednej, konkretniej pozycji z tabeli pacjentów z bazy danych. 
*
* Metoda pozwala odczytaæ pozycjê pacjenta o podanym id z bazy danych.
*
* @param $patientID id pacjenta, który ma byæ odczytany
* @return tablica wszystkich obiektów w tabeli pacjentów.
*/
    public function readOne($patientID) {

        $queryString = "SELECT * FROM voiceparametrization.parameters WHERE pacjent_ID = ?";
        $queryData = $this->dbConnection->prepare($queryString);
        $queryData->execute(array($patientID));
        $result = $queryData->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

/**
* Metoda s³u¿¹ca do uzyskania ostatniej wartoœci auto inkrementuj¹cego siê klucza podstawowego z tabeli pacjentów. 
*
* @return ostatnia wartoœæ klucza podstawowego (pacjent_ID)
*/
    public function getLastRecordingId() {
        $queryString = "SELECT AUTO_INCREMENT FROM information_schema.tables WHERE table_name = 'parameters' AND table_schema = 'voiceparametrization'";
        $queryData = $this->dbConnection->prepare($queryString);
        $queryData->execute();
        $result = $queryData->fetch();
        return $result;
    }
}
