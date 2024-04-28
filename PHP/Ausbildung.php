<?php
require_once "./XML/Database.php";
$database = new Database();
$Projects = $database->GetAllProjects();

function ProjectPanels($Projects){
    for ($i = 0; $i < count($Projects); $i++){
        if ($i % 2 == 0) {
            if($Projects[$i]['Link'] != NULL){
                echo "
                <div class='project'>
                    <div style='width: 65%;'>
                        <h3>{$Projects[$i]['Name']}</h3>
                        <p>{$Projects[$i]['Description']}</p>
                        <p>Erstellt vom Lehrjahr {$Projects[$i]['Year']}</p>
                        <button class='active' onclick=\"openLink('{$Projects[$i]['Link']}', '_blank')\">
                            Zur Website <span class='bi bi-box-arrow-up-right'></span>
                        </button>
                    </div>
                    <div style='width: 35%;'>
                        <img style='cursor: pointer;' src='".$Projects[$i]['ImgSrc']."' onclick=\"openLink('{$Projects[$i]['Link']}', '_blank')\">
                    </div>
                </div>
                ";
            }
            else{
                echo "
                <div class='project'>
                    <div style='width: 65%;'>
                        <h3>{$Projects[$i]['Name']}</h3>
                        <p>{$Projects[$i]['Description']}</p>
                        <p>Erstellt vom Lehrjahr {$Projects[$i]['Year']}</p>
                    </div>
                    <div style='width: 35%;'>
                        <img style='cursor: pointer;' src='".$Projects[$i]['ImgSrc']."' onclick=\"openLink('{$Projects[$i]['Link']}', '_blank')\">
                    </div>
                </div>
            ";
            }

        } else {
            if($Projects[$i]['Link'] != NULL){
                echo "
                <div class='project'>
                    <div style='width: 35%;'>
                    <img style='cursor: pointer;' src='".$Projects[$i]['ImgSrc']."' onclick=\"openLink('{$Projects[$i]['Link']}', '_blank')\">
                    </div>
                    <div style='width: 65%; text-align: right;'>
                        <h3>{$Projects[$i]['Name']}</h3>
                        <p>{$Projects[$i]['Description']}</p>
                        <p>Erstellt vom Lehrjahr {$Projects[$i]['Year']}</p>
                        <button class='active' onclick=\"openLink('{$Projects[$i]['Link']}', '_blank')\">
                            Zur Website <span class='bi bi-box-arrow-up-right'></span>
                        </button>
                    </div>
                </div>
                ";
            }
            else{
                echo "<div class='project'>
                    <div style='width: 35%;'>
                    <img style='cursor: pointer;' src='".$Projects[$i]['ImgSrc']."' onclick=\"openLink('{$Projects[$i]['Link']}', '_blank')\">
                    </div>
                    <div style='width: 65%; text-align: right;'>
                        <h3>{$Projects[$i]['Name']}</h3>
                        <p>{$Projects[$i]['Description']}</p>
                        <p>Erstellt vom Lehrjahr {$Projects[$i]['Year']}</p>
                    </div>
                </div>";
            }

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

    <link rel="stylesheet" type="text/CSS" href="./CSS/bootstrap.min.css">
    <link rel="stylesheet" type="text/CSS" href="./CSS/styles.css">
    <link rel="icon" href="./IMG/Logos/BBWLogo.ico">
    <script src="./JS/bootstrap.min.js"></script>
    <script src="./JS/jquery.js"></script>
    <script src="./JS/scripts.js"></script>

    <title>ITSC</title>
</head>


<body>
    <header>
        <h3 class="header">
            <img src="./IMG/Logos/BBWLogo.png" style="width: 75px;">
            <span id="headerTitle">Bugenhagenwerk - IT Ausbildung</span>
        </h3>
        <div class="right">
            <a href="./PHP/Team.php">Das Team</a>
            <a href="./PHP/DeutscheBahn2.php">Deutsche-Bahn</a>
        </div>
        <span class="bi bi-list list" style="display: none;"></span>
        <div class="header-dropdown" style="display: none;">
            <a href="./PHP/Team.php">Das Team</a>
            <a href="./PHP/DeutscheBahn2.php">Deutsche-Bahn</a>
        </div>
    </header>
    <main>
        <div class="projects">
            <h2>Unsere Projekte</h2>
            <?php ProjectPanels($Projects) ?>
        </div>
    </main>
</body>

</html>