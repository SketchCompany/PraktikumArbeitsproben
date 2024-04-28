<?php

require_once "./database.php";
$database = new Database();

$LastName = $_POST["LastName"];
$FirstName = $_POST["FirstName"];

if (empty($_FILES["IMG"]["name"])) {
    $randoArray = ['Bear', 'Birb', 'Cat', 'Chameleon', 'DeerF', 'DeerM', 'Dog', 'Dragonfly', 'Elephant', 'Fish', 'Fox', 'Frog', 'Giraffe', 'Gorilla', 'Kangaroo', 'Kolibri', 'Lion', 'Mole', 'Monkey', 'Mouse', 'Otter', 'Owl', 'Parrot', 'Penguin', 'Platypus', 'Rabbit', 'Raccoon', 'Seelion', 'Snake', 'Tortoise'];

    $originalFilePath = 'C:/inetpub/wwwroot/Ausbildungsseite/IMG/PFP/Default/' . $randoArray[random_int(0, 30)] . '.png';
    $newDirectoryPath = 'C:/inetpub/wwwroot/Ausbildungsseite/IMG/PFP/';
    $newFileName = $FirstName . $LastName . '.png';

    copy($originalFilePath, $newDirectoryPath . '\\' . $newFileName);
}
else{
    $target_dir = "C:/inetpub/wwwroot/Ausbildungsseite/IMG/PFP/";
    $target_file = $target_dir . basename($FirstName . $LastName) . ".png";
    move_uploaded_file($_FILES["IMG"]["tmp_name"], $target_file);
}

$database->BackendAddPerson($LastName, $FirstName);