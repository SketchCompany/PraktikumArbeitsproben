<?php
require_once "../XML/Database.php";

$database = new Database();
$Peoples = $database->GetAllPeoples();

function CreatePersonBox($Lehrjahr, $Peoples){
    for ($i = 0; $i < count($Peoples); $i++) {
        if ($Peoples[$i]['Year'] == $Lehrjahr) {
            echo ("
                <div class='PersonenBoxTeamPage'>
                    <img id='Image' src=".$Peoples[$i]['ImgSrc']." alt=''>
                    <p><b>" . $Peoples[$i]['FirstName'] . ' ' . $Peoples[$i]['LastName'] . "</b></p>
                </div>
            ");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="stylesheet" type="text/CSS" href="../CSS/bootstrap.min.css">
    <link rel="stylesheet" type="text/CSS" href="../CSS/styles.css">
    <link rel="icon" href="../IMG/Logos/BBWLogo.ico">
    <script src="../JS/bootstrap.min.js"></script>
    <script src="../JS/jquery.js"></script>
    <script src="../JS/scripts.js"></script>

    <title>Das Team</title>
</head>
    <body>
        <header>
            <h3 class="header">
                <img onclick="openLink('../')" src="../IMG/Logos/BBWLogo.png" style="width: 75px;">
                <span onclick="openLink('../')" id="headerTitle">Bugenhagenwerk - IT Ausbildung</span>
            </h3>
            <div class="right">
                <a href="Team.php">Das Team</a>
                <a href="DeutscheBahn2.php">Deutsche-Bahn</a>
            </div>
            <span class="bi bi-list list" style="display: none;"></span>
            <div class="header-dropdown" style="display: none;">
                <a href="Team.php">Das Team</a>
                <a href="DeutscheBahn2.php">Deutsche-Bahn</a>
            </div>
        </header>
        <div id="ContainerTeamPage">
            <h2><b>Ausbilder</b></h2>
            <div class="HeaderTeamPage">
                <?php CreatePersonBox(17, $Peoples) ?>
            </div><hr><br>

            <h2><b>3tes Lehrjahr</b></h2>
            <div class="HeaderTeamPage">
                <?php CreatePersonBox(3, $Peoples) ?>
            </div><hr><br>

            <h2><b>2tes Lehrjahr</b></h2>
            <div class="HeaderTeamPage">
                <?php CreatePersonBox(2, $Peoples) ?>
            </div><hr>
        </div>
    </body>
</html>