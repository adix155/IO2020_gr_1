<?php
class DBController {
    private $connectionString = "mysql:host=localhost;dbname=voiceparametrization;charset=utf8";
    private $dbUsername = "root";
    private $dbPassword = "";
    public $dbConnection;

    function __construct() {
        $this->dbConnection = new PDO($this->connectionString, $this->dbUsername, $this->dbPassword);
    }

    public function readData() {
        $queryString = "SELECT * FROM voiceparametrization.parameters";
        $queryData = $this->dbConnection->prepare($queryString);
        $queryData->execute();
        $result = $queryData->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function addData($patientName, $patientSurname, $patientAge, $patientGender, $CPP, $H1H2, $HRF, $NAQ, $PSP, $QOQ, $MDQ, $PS, $RDS, $rbhScale, $recordingName, $plotName) {
        $queryString = "INSERT INTO voiceparametrization.parameters () VALUES ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ?";
        $queryData = $this->dbConnection->prepare($queryString);
        $queryData->execute(array($patientName, $patientSurname, $patientAge, $patientGender, $CPP, $H1H2, $HRF, $NAQ, $PSP, $QOQ, $MDQ, $PS, $RDS, $rbhScale, $recordingName, $plotName));
        return;
    }

    public function editData($patientNameSurname, $rbhScale, $patientID) {
        $patientData = explode(" ", $patientNameSurname);
        $patientName = $patientData[0];
        $patientSurname = $patientData[1];
        $queryString = "UPDATE voiceparametrization.parameters SET imie = ? , nazwisko = ? , RBH = ? WHERE pacjent_ID = ?";
        $queryData = $this->dbConnection->prepare($queryString);
        $queryData->execute(array($patientName, $patientSurname, $rbhScale, $patientID));
        return;
    }

    public function deleteData($patientID) {
        $queryString = "DELETE FROM voiceparametrization.parameters WHERE pacjent_ID = ?";
        $queryData = $this->dbConnection->prepare($queryString);
        $queryData->execute(array($patientID));
        return;
    }

    public function readOne($patientID) {
        $queryString = "SELECT * FROM voiceparametrization.parameters WHERE pacjent_ID = ?";
        $queryData = $this->dbConnection->prepare($queryString);
        $queryData->execute(array($patientID));
        $result = $queryData->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}