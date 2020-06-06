<?php
class FileUpload
{
    public static function checkForUploadErrors()
    {
        if ($_FILES['recording']['error'] > 0) {
            $_SESSION['file_upload_error'] =  'Wystąpił problem: ';
            switch ($_FILES['recording']['error']) {
                    // jest większy niż domyślny maksymalny rozmiar,
                    // podany w pliku konfiguracyjnym
                case 1: {
                        $_SESSION['file_upload_error'] .= 'Rozmiar pliku jest zbyt duży.';
                        break;
                    }

                    // jest większy niż wartość pola formularza 
                    // MAX_FILE_SIZE
                case 2: {
                        $_SESSION['file_upload_error'] .=  'Rozmiar pliku jest zbyt duży.';
                        break;
                    }

                    // plik nie został wysłany w całości
                case 3: {
                        $_SESSION['file_upload_error'] .= 'Plik wysłany tylko częściowo.';
                        break;
                    }

                    // plik nie został wysłany
                case 4: {
                        $_SESSION['file_upload_error'] .= 'Nie wysłano żadnego pliku.';
                        break;
                    }

                    // pozostałe błędy
                default: {
                        $_SESSION['file_upload_error'] .= 'Wystąpił błąd podczas wysyłania.';
                        break;
                    }
            }
            return false;
        }
        return true;
    }

    public static function checkMIMEType()
    {
        if ($_FILES['recording']['type'] != 'audio/wav') {
            $_SESSION['file_type_error'] = 'Niepoprawny typ pliku: obsługiwane są tylko pliki .wav!';
            return false;
        }
        return true;
    }

    public static function uploadFile($recordingID)
    {
        // $uploadDir = '/var/www/html/octave/recordings/';
        $uploadDir = './octave/recordings/';
        $recordingName = "rec_$recordingID.wav";
        $location = $uploadDir . $recordingName;

        if (is_uploaded_file($_FILES['recording']['tmp_name'])) {
            if (!move_uploaded_file($_FILES['recording']['tmp_name'], $location)) {
                echo 'Nie udało się skopiować pliku do katalogu.';
                return false;
            }
        } else {
            echo 'Możliwy atak podczas przesyłania pliku.';
            echo 'Plik nie został zapisany.';
            return false;
        }
        return $recordingName;
    }
}