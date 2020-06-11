<?php

/**
* Klasa s�u��ca do ��czenia z baz� danych.
*
* Klasa zawiera metady do odczytu edycji i zapisu do bazy danych powi�zanych z nagraniami g�osu, takimi jak imi�, nazwisko czy wiek pacjenta a tak�e wyliczone parametry.
*/
class DBController {
/**
* Prywatna zmienna przechowuj�ca dane do po��czenia z baz� danych tj. adres serwera MySQL, nazw� bazy oraz kodowanie znak�w.
*/
    private $connectionString = "mysql:host=localhost;dbname=voiceparametrization;charset=utf8";
/**
* Prywatna zmienna przechowuj�ca login do MySQL.
*/
    private $dbUsername = "root";
/**
* Prywatna zmienna przechowuj�ca has�o do MySQL.
*/
    private $dbPassword = "zaq1@WSX";
/**
* Publiczny obiekt klasy PDO, reprezentuj�cej po��czenie PHP z serwerem MySQL.
*/
    public $dbConnection;
/**
* Konstruktor klasy DBController inicjalizuj�cy po��czenie z baz� danych.
*/
    function __construct() {
        $this->dbConnection = new PDO($this->connectionString, $this->dbUsername, $this->dbPassword);
    }
/**
* Metoda s�u��ca do odczytu wszystkich danych pacjent�w z bazy danych. 
*
* @return tablica wszystkich obiekt�w w tabeli pacjent�w.
*/
    public function readData() {
        $queryString = "SELECT * FROM voiceparametrization.parameters";
        $queryData = $this->dbConnection->prepare($queryString);
        $queryData->execute();
        $result = $queryData->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
/**
* Metoda s�u��ca do dodawania nowej pozycji do tabeli pacjent�w z bazy danych. 
*
* Metoda dodaje do tabeli pacjent�w now� pozycj�, wraz z wszystkimi danymi osobistymi i ju� obliczonymi parametrami.
*
* @param $insertArray tablica zawieraj�ca dane do wpisu w nast�puj�cej kolejno�ci: imie , nazwisko , plec , wiek , CPP , H1H2 , HRF , NAQ , PSP , QOQ , MDQ , PS , RDS , RBH , nazwa nagrania
*
*/
    public function addData($insertArray) {
        $queryString = "INSERT INTO voiceparametrization.parameters (imie , nazwisko , plec , wiek , CPP , H1H2 , HRF , NAQ , PSP , QOQ , MDQ , PS , RDS , RBH , recording_name , amplitude_name) VALUES (? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ?)";
        $queryData = $this->dbConnection->prepare($queryString);
        $queryData->execute($insertArray);
        return;
    }
/**
* Metoda s�u��ca do edytowania pozycji w tabeli pacjent�w z bazy danych. 
*
* Metoda pozwala edytowa� imi�, nazwisko oraz skal� rbh pacjenta o podanym id.
*
* @param $patientNameSurname string zawieraj�cy nowe imi� i nazwisko, rozdzielone spacjami 
* @param $rbhScale string zawieraj�cy now� skala rbh
* @param $patientID id pacjenta, kt�ry ma by� edytowany
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
* Metoda s�u��ca do usuni�cia pozycji w tabeli pacjent�w z bazy danych. 
*
* Metoda pozwala usun�� pozycj� pacjenta o podanym id z bazy danych.
*
* @param $patientID id pacjenta, kt�ry ma by� usuni�ty
*
*/
    public function deleteData($patientID) {
        $queryString = "DELETE FROM voiceparametrization.parameters WHERE pacjent_ID = ?";
        $queryData = $this->dbConnection->prepare($queryString);
        $queryData->execute(array($patientID));
        return;
    }

/**
* Metoda s�u��ca do odczytu jednej, konkretniej pozycji z tabeli pacjent�w z bazy danych. 
*
* Metoda pozwala odczyta� pozycj� pacjenta o podanym id z bazy danych.
*
* @param $patientID id pacjenta, kt�ry ma by� odczytany
* @return tablica wszystkich obiekt�w w tabeli pacjent�w.
*/
    public function readOne($patientID) {

        $queryString = "SELECT * FROM voiceparametrization.parameters WHERE pacjent_ID = ?";
        $queryData = $this->dbConnection->prepare($queryString);
        $queryData->execute(array($patientID));
        $result = $queryData->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

/**
* Metoda s�u��ca do uzyskania ostatniej warto�ci auto inkrementuj�cego si� klucza podstawowego z tabeli pacjent�w. 
*
* @return ostatnia warto�� klucza podstawowego (pacjent_ID)
*/
    public function getLastRecordingId() {
        $queryString = "SELECT AUTO_INCREMENT FROM information_schema.tables WHERE table_name = 'parameters' AND table_schema = 'voiceparametrization'";
        $queryData = $this->dbConnection->prepare($queryString);
        $queryData->execute();
        $result = $queryData->fetch();
        return $result;
    }
}
