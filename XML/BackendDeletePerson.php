<?php

require_once "./database.php";
$database = new Database();

$ID = $_POST["ID"];

$database->BackendDeletePerson($ID);