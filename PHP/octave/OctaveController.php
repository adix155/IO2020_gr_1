<?php
class OctaveController {
    public static function getVoiceParams($recordingPath, $newRecordingID) {
        exec("octave-gui covarep.m $recordingPath $newRecordingID");
    }
}