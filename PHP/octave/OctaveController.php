<?php
class OctaveController {
    public static function getVoiceParams($recordingPath, $insertingID) {
        chdir("/var/www/html/octave/functions");
        exec("octave-cli Covarep_testing.m ../recordings/rec_$insertingID.wav $insertingID");
        $tempFilename = "temp-params_$insertingID.csv";
        $csvFileHandle = fopen($tempFilename, "r");
        $csvParameters = fgets($csvFileHandle);
        $parameters = explode(",", $csvParameters);
        fclose($csvFileHandle);
        unlink($tempFilename);
        chdir("../..");
        return $parameters;
    }
}
