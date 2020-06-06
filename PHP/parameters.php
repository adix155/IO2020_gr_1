<?php
session_start();
include_once("./octave/OctaveController.php");
include_once("./FileUpload.php");
include_once("./DBController.php");
set_time_limit(450);
if (FileUpload::checkForUploadErrors() != false) {
    if (FileUpload::checkMIMEType() != false) {
        $db = new DBController();
        $lastId = $db->getLastRecordingId()[0];
        $uploadedRecordingName = FileUpload::uploadFile($lastId);
        if ($uploadedRecordingName == true) echo 'Udało się zapisać plik!';
        $parameters = OctaveController::getVoiceParams("/var/www/html/octave/recordings/" . $uploadedRecordingName, $lastId);
        for($i = 1; $i < count($parameters); $i++) {
            $parameters[$i] = number_format(floatval($parameters[$i]), 4);
        }
        $patient = explode(" ", $_POST["name"]);
        $patientName = $patient[0];
        $patientSurname = $patient[1];
        $patientAge = intval($_POST["age"]);
        $patientGender = $_POST["plec"];
        $patientInfo = array($patientName, $patientSurname, $patientGender, $patientAge);
        $rbhScale = floatval($_POST["RBH"]);
        $insertArray = array_merge($patientInfo, $parameters);
        array_push($insertArray, $rbhScale, "", "");
        $db->addData($insertArray);
        $db = null;
        header("Location: data.php");
        die();
    }
}
