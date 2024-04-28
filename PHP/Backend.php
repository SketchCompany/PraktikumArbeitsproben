<?php
require_once "../XML/Database.php";
$database = new Database();
$People = $database->GetAllPeoples();
$Project = $database->GetAllProjects();

$ProjectABC = $Project;
function sortByProjectName($a, $b) { return strcmp($a["Name"], $b["Name"]); }
usort($ProjectABC, "sortByProjectName");
foreach ($ProjectABC as $key => $project) { $ProjectABC[$key]["ID"] = $key + 1; }


function PersonList($People) {
    for ($i = 0; $i < sizeof($People); $i++) {
        echo("<option value='" . $People[$i]['ID'] . "'>" . $People[$i]['FirstName'] . " " . $People[$i]['LastName'] . ", Lehrjahr: " . $People[$i]['Year'] . "</option>");
    }
}

function ProjectList($Project) {
    for ($i = 0; $i < sizeof($Project); $i++) {
        echo ("<option value='" . $Project[$i]['ID'] . "'>" . $Project[$i]['Name'] . "</option>");
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
    <script src="../JS/BackendJS.js"></script>
    <script src="../JS/XML.js"></script>

    <title>Backend des ITSC</title>
</head>

    <body id="BackendBody">
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
        <div id="BackendInnerBody">
            <img src="../IMG/Logos/back.png" id='BackendNextPage' class="BackendButton" onclick='PrevPage()'>

                <div id="BackendPeople" class="BackendBlock">
                    <p>Das Team Bearbeiten</p>
                    <div class="BackendBlockBlue">
                        <div class="BackendBlockWhite">
                            <h1>Azubis Bearbeiten</h1>
                            <div>
                                <label for="People">Azubi auswählen: </label>
                                <select name="People" id="PeopleList">
                                    <option value='0'></option>
                                    <?php PersonList($People); ?>
                                </select>
                            </div>
                            <div>
                                <button id="BackendDelete" onclick="BackendDeletePerson()">Löschen</button>
                                <button id="BackendPlusOne" onclick="BackendPlusOne()">Lehrjahr +1</button>
                            </div>
                        </div>
                        <br>
                        <div class="BackendBlockWhite">
                            <h1>Azubis Hinzufügen</h1>
                            <div>
                                <input type="text" id="BackendLastName" placeholder="Nachname">
                                <input type="text" id="BackendFirstName" placeholder="Vorname">
                            </div>
                            <div>
                                <input type="file" id="BackendSCPBL" accept="image/*">
                                <button id="BackendAdd" onclick="BackendAddPerson()">Hinzufügen</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="BackendProject" class="BackendBlock">
                    <p>Projekt Erstellen</p>
                    <div class="projects">
                        <div>
                            <label for="Project">Projekt auswählen: </label>
                            <select name="Project" id="ProjectList" onchange="test(<?php echo htmlspecialchars(json_encode($ProjectABC)); ?>)">
                                <option value='0'></option>
                                <?php ProjectList($ProjectABC); ?>
                            </select>
                        </div>
                        <div class='project' style='width: fit-content;'>
                            <div id='BackendLeftBox'>
                                <h1>Titel: </h1>
                                <input id='BackendTitle' type='text' placeholder='ITSC Backend Seite' style='width:100%'>
                                <h1>Lehrjahr: </h1>
                                <input id='BackendYear' type='number' placeholder='2022' style='width:100%'>
                                <h1>Website Link</h1>
                                <input id='BackendLink' type='text' style='width:100%; Margin-bottom:0px !important' placeholder='http://10.64.19.16/Ausbildungsseite/'>
                            </div>
                            <div id='BackendRightBox'>
                                <h1>Beschreibung: </h1>
                                <textarea id='BackendDescription' placeholder='Das Backend der ITSC Ausbildungsseite kann genutzt werden um neue Azubis oder Projekte zu erstellen'></textarea>
                                <h1>Bild: </h1>
                                <input id='BackendIMG' type="file" accept="image/*">
                            </div>
                        </div>
                        <div>
                            <button class="active" onclick="BackendAddProject()">Projekt Hinzugügen</button>
                            <button class="active" onclick="BackendDelProject()">Projekt Löschen</button>
                        </div>
                    </div>
                    <br>
                </div>

            <img src="../IMG/Logos/front.png" id='BackendPrevPage' class="BackendButton" onclick='NextPage()'>
        </div>
    </body>

</html>







