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

    <title>Carrera Bahn</title>
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
    <main>
        <div class="siteContainers">
            <h1 class="headline">Carrera Bahn</h1>
            <div class='siteContainer'>
                <div class="siteContainerRow">
                    <div class="siteContainerContent">
                        <p>Auto goes BrummBrumm</p>
                    </div>
                    <img src='../IMG/Logos/Auto1.jpg'>
                </div>
	    	    <div class="siteContainerRow">
              	    <img src='../IMG/Logos/Auto2.jpg'>
                    <div class="siteContainerContent">
                    	<p>Nyom</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>