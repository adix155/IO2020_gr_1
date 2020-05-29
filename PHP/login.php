<?php
session_start();
include_once("AccountController.php");

if(isset($_POST["guest"])) {
    AccountController::login();
    die();
}

$sanitizedUsername = filter_var($_POST["username"], FILTER_SANITIZE_SPECIAL_CHARS);
$sanitizedPassword = filter_var($_POST["password"], FILTER_SANITIZE_SPECIAL_CHARS);
AccountController::login($sanitizedUsername, $sanitizedPassword);
die();