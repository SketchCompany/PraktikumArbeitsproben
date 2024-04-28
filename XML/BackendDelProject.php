<?php

require_once "./database.php";
$database = new Database();

$Title = $_POST["Title"];

$database->BackendDelProject($Title);