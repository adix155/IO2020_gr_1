<?php
session_start();
include_once("AccountController.php");

AccountController::logout();
die();