<?php
include_once('DBController.php');

/**
*Klasa zawieraj�ca statyczne metody do kontakt�w z tabel� u�ytkownik�w w bazie danych a tak�e do logowaniai wylogowania oraz tworzenia nowych kont.
*/
class AccountController {

/**
* Statyczna metoda s�u��ca do logowania u�ytkownika. 
*
* Metoda sprawdza istnienie u�ytkownika o podanej nazwie w bazie danych, a tak�e poprawno�� podanego has�a i w razie b�ed�w w podanych danych ustawia adekwatne flagi. W przypadku gdy dane s� poprawne
* ustawiana jest globalna zmienna, pokazuj�ca poziom uprawnie� u�ytkownika oraz ustawiana jest globalna flaga m�wi�ca, �e u�ytkownik jest zalogowany.
*
* @param $inputUsername zsanityzowany string zawieraj�cy login u�ytkownika, kt�ry chce si� zalogowa�. Dowy�lna warto�� tego parametru to "guest"
* @param $inputPassword zsanityzowany string zawieraj�cy has�o u�ytkownika, kt�ry chce si� zalogowa�. Dowy�lna warto�� tego parametru to "guest"
*
*/
    public static function login($inputUsername = "guest", $inputPassword = "guest") {
        $db = new DBController();
        $dbConn = $db->dbConnection;
        $queryString = "SELECT voiceparametrization.users.username, voiceparametrization.users.password_hash, voiceparametrization.users.user_role FROM voiceparametrization.users WHERE voiceparametrization.users.username = ?";
        $queryData = $dbConn->prepare($queryString);
        $queryData->execute(array($inputUsername));
        echo $queryData->rowCount();
        if($queryData->rowCount() > 0) {
            $userData = $queryData->fetch(PDO::FETCH_ASSOC);
            if (password_verify($inputPassword, $userData["password_hash"])) {
                $_SESSION["logged_in"] = true;
                $_SESSION["user_role"] = $userData["user_role"];
                $dbConn = null;
                $db = null;
                header("Location: data.php");
                return;
            } else {
                $_SESSION["invalid_password"] = true;
                header("Location: index.php");
                return;
            }
        } else {        
            $_SESSION["user_doesnt_exist"] = true;
            header("Location: index.php");
            return;
        }
    }

/**
* Statyczna metoda s�u��ca do wylogowania u�ytkownika. 
*
* Metoda ko�czy istniej�c� sesj�, niszcz�c wszystkie globalne zmienne i flagi a tak�e przesy�a u�ytkownika do ekranu logowania.
*/
    public static function logout() {
        session_unset();
        $_SESSION = array();
        session_destroy();
        header('Location: index.php');
        return;
    }

/**
* Statyczna metoda s�u��ca do zarejestrowania nowego u�ytkownika. 
*
* Metoda dodaje do bazy danych u�ytkownika o danych podanych w parametrach.
*
* @param $userName nazwa u�ytkownika, kt�ry ma by� dodany do bazy danych
* @param $userPassword has�o u�ytkownika, kt�ry ma by� dodany do bazy danych
* @param $userRole poziom uprawnie� u�ytkownika, kt�ry ma by� dodany do bazy danych
*/
    public static function register($userName, $userPassword, $userRole) {
        $db = new DBController();
        $dbConn = $db->dbConnection;
        $queryString = "INSERT INTO voiceparametrization.users (username, password_hash, user_role) VALUES (?, ?, ?)";
        $passwordHash = password_hash($userPassword, PASSWORD_DEFAULT);
        $queryData = $dbConn->prepare($queryString);
        $queryData->execute(array($userName, $passwordHash, $userRole));
        $dbConn = null;
        $db = null;
        return;
    }
}