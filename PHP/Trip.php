<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/CSS" href="../CSS/bootstrap.min.css">
    <link rel="stylesheet" type="text/CSS" href="../CSS/styles.css">
    <link rel="stylesheet" type="text/CSS" href="../CSS/trip.css">
    <link rel="icon" href="../IMG/Logos/BBWLogo.ico">
    <script src="../JS/bootstrap.min.js"></script>
    <script src="../JS/jquery.js"></script>
    <script src="../JS/scripts.js"></script>
    <script src="../JS/tripAPI.js"></script>

    <title>... | Bugenhagenwerk - IT Ausbildung</title>
</head>
<body>
    <header>
        <h3 class="header">
            <img onclick="openLink('../')" src="../IMG/Logos/BBWLogo.png" style="width: 75px;">
            <span onclick="openLink('../')" id="headerTitle">Bugenhagenwerk - IT Ausbildung</span>
        </h3>
        <div class="right">
            <a href="../PHP/Team.php">Das Team</a>
            <a href="../PHP/DeutscheBahn2.php">Deutsche-Bahn</a>
        </div>
        <span class="bi bi-list list" style="display: none;"></span>
        <div class="header-dropdown" style="display: none;">
            <a href="../PHP/Team.php">Das Team</a>
            <a href="../PHP/DeutscheBahn2.php">Deutsche-Bahn</a>
        </div>
    </header>
    <main>
        <div>
            <div class="trip">
                <div class="crow">
                    <img id="toppic" style="width: 75px; border-radius: 0;">
                </div>
                <div class="crow">
                    <div class="ccolumn">
                        <p id="tripLineType"></p>
                        <h3 id="tripLineName" class="platform"></h3>
                    </div>
                    <div class="ccolumn">
                        <p>Fahrt Nr.</p>
                        <h3 id="tripNumber"></h3>
                    </div>
                </div>
                <div class="crow">
                    <div class="ccolumn">
                        <p>Start</p>
                        <h3 id="tripOrigin" class="target"></h3>
                    </div>
                    <div class="ccolumn">
                        <p>Ziel</p>
                        <h3 id="tripName" class="target"></h3>
                    </div>
                </div>
                <div class="crow">
                    <div class="ccolumn">
                        <p>Abfahrt</p>
                        <h3 id="tripDeparture"></h3>
                        <p id="tripDepartureDelay" class="delay"></p>
                    </div>
                    <div class="ccolumn">
                        <p>Ankuft</p>
                        <h3 id="tripArrival"></h3>
                        <p id="tripArrivalDelay" class="delay"></p>
                    </div>
                </div>
                <div class="crow">
                    <div class="ccolumn">
                        <p>Abfahrt von</p>
                        <h3 id="tripDeparturePlatform" class="platform"></h3>
                    </div>
                    <div class="ccolumn">
                        <p>Einfahrt in</p>
                        <h3 id="tripArrivalPlatform" class="platform"></h3>
                    </div>
                </div>
            </div>
            <div class="stopovers">
                <h1>Haltestellen</h1>
                <!-- <div id="stopover">
                    <div class="crow">
                        <p>Name</p>
                        <h3 id="tripStopoverName"></h3>
                    </div>
                    <div class="crow">
                        <div class="column">
                            <p>Ankunft</p>
                            <h3 id="tripStopoverArrival"></h3>
                            <p id="tripStopoverArrivalDelay"></p>
                        </div>
                        <div class="column">
                            <p>Abfahrt</p>
                            <h3 id="tripStopoverDeparture"></h3>
                            <p id="tripStopoverDepartureDelay"></p>
                        </div>
                    </div>
                    <div class="crow">
                        <div class="ccolumn">
                            <p>Einfahrt in</p>
                            <h3 id="tripStopoverArrivalPlatform"></h3>
                        </div>
                        <div class="ccolumn">
                            <p>Abfahrt von</p>
                            <h3 id="tripStopoverDeparturePlatform"></h3>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </main>
</body>
</html>