<?php
include_once('DBController.php');
class AccountController {
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

    public static function logout() {
        session_unset();
        $_SESSION = array();
        session_destroy();
        header('Location: index.php');
        return;
    }

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