<?php

require_once "./database.php";
$database = new Database();

$Title = $_POST["Title"];
$Year = $_POST["Year"];
$Link = $_POST["Link"];
$Desc = $_POST["Desc"];

$target_dir = "C:/inetpub/wwwroot/Ausbildungsseite/IMG/Projects/";
$target_file = $target_dir . basename($Title) . ".png";
move_uploaded_file($_FILES["IMG"]["tmp_name"], $target_file);

$database->BackendAddProject($Title, $Year, $Link, $Desc);