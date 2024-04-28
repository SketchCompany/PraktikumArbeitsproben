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
    <script src="../JS/API.js"></script>
    <script src="../JS/scripts.js"></script>

    <title>Deutsche Bahn | Bugenhagenwerk - IT Ausblidung</title>
</head>
<body>
    <header>
        <h3 class="header">
            <img onclick="openLink('../')" src="../IMG/Logos/BBWLogo.png" style="width: 75px;">
            <span onclick="openLink('../')" id="headerTitle">Bugenhagenwerk - IT Ausbildung</span>
        </h3>
        <div class="right">
            <a href="Team.php">Das Team</a>
            <a href="DeutscheBahn.php">Deutsche-Bahn</a>
        </div>
        <span class="bi bi-list list" style="display: none;"></span>
        <div class="header-dropdown" style="display: none;">
            <a href="Team.php">Das Team</a>
            <a href="DeutscheBahn.php">Deutsche-Bahn</a>
        </div>
    </header>
    <main>
        <div class="navigation">
            <div>
                <select name="stations" id="stations">
                    <option value="8005874">Timmendorf Bahnhof</option>
                    <option value="8000749">Bad Schwartau</option>
                    <option value="8002549">Hamburg Hauptbahnhof</option>
                    <option value="8000199">Kiel Hauptbahnhof</option>
                    <option value="8000237">Lübeck Hauptbahnhof</option>
                    <option value="8003781">Lübeck Flughafen</option>
                    <option value="8003785">Lübeck Hochschulstadtteil</option>
                    <option value="8003776">Lübeck-Kücknitz</option>
                    <option value="8003778">Lübeck-Travemünde Strand</option>
                    <option value="8004327">Neustadt (Holst)</option>
                    <option value="8005321">Scharbeutz</option>
                </select>
                <div class="options">
                    <button onclick="openAll()" class="active">Alle</button>
                    <button onclick="openBus()">Bus</button>
                    <button onclick="openTrain()">Zug</button>
                </div>
            </div>
            <button onclick="test()"><span class="bi bi-arrow-clockwise"></span></button>
        </div>
        <div id="bus" class="connections" style="display: none;">
                <?php for ($i = 0; $i < 50; $i++) { ?>
                    <div class="connection" id="Bconnection<?php echo $i ?>">
                        <div class="type">
                            <div class="first ccolumn">
                                <p id="Bsection<?php echo $i ?>"></p>
                                <h3 class="platform" id="Bplatform<?php echo $i ?>"></h3>
                                <div>
                                    <p id="Btrain<?php echo $i ?>"></p>
                                    <img id="Bicon<?php echo $i?>" style="width: 2.5vw;">
                                </div>
                            </div>
                            <div class="ccolumn">
                                <h3 id="Btarget<?php echo $i ?>" class="target"></h3>
                                <p>Ziel</p>
                                <p id="Bnumber<?php echo $i ?>"></p>
                            </div>
                        </div>
                        <div class="time ccolumn">
                            <h3 id="Bdeparture<?php echo $i ?>"></h3>
                            <p>Abfahrt</p>
                            <p id="Bdelay<?php echo $i ?>" class="delay"></p>
                        </div>
                    </div>
                <?php } ?>
            <!-- <div class="connection">
                <div>
                    <h3>Gleis 8</h3>
                    <p>RE87</p>
                </div>
                <div>
                    <h3>Hamburg</h3>
                    <p>Ziel</p>
                </div>
                <div>
                    <div class="times">
                        <h3 class="planned">08:58</h3>
                        <h3>08:59</h3>
                    </div>
                    <p>Abfahrt</p>
                    <p>1 min Verspätung</p>
                </div>
                <div>
                    <h3>09:46</h3>
                    <p>Ankuft</p>
                </div>
            </div> -->
        </div>
        <div id="train" class="connections" style="display: none;">
            <?php for ($i = 0; $i < 50; $i++) { ?>
                <div class="connection" id="Tconnection<?php echo $i ?>">
                    <div class="type">
                        <div class="first ccolumn">
                            <p id="Tsection<?php echo $i ?>"></p>
                            <h3 class="platform" id="Tplatform<?php echo $i ?>"></h3>
                            <div>
                                <p id="Ttrain<?php echo $i ?>"></p>
                                <img id="Ticon<?php echo $i?>" style="width: 2.5vw;">
                            </div>
                        </div>
                        <div class="ccolumn">
                            <h3 id="Ttarget<?php echo $i ?>" class="target"></h3>
                            <p>Ziel</p>
                            <p id="Tnumber<?php echo $i ?>"></p>
                        </div>
                    </div>
                    <div class="time ccolumn">
                        <h3 id="Tdeparture<?php echo $i ?>"></h3>
                        <p>Abfahrt</p>
                        <p id="Tdelay<?php echo $i ?>" class="delay"></p>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div id="all" class="connections" style="display: flex;">
            <?php for ($i = 0; $i < 50; $i++) { ?>
                <div class="connection" id="connection<?php echo $i ?>">
                    <div class="type">
                        <div class="first ccolumn">
                            <p id="section<?php echo $i ?>"></p>
                            <h3 class="platform" id="platform<?php echo $i ?>"></h3>
                            <div>
                                <p id="train<?php echo $i ?>"></p>
                                <img id="icon<?php echo $i?>" style="width: 2.5vw;">
                            </div>
                        </div>
                        <div class="ccolumn">
                            <h3 id="target<?php echo $i ?>" class="target"></h3>
                            <p>Ziel</p>
                            <p id="number<?php echo $i ?>"></p>
                        </div>
                    </div>
                    <div class="time ccolumn">
                        <h3 id="departure<?php echo $i ?>"></h3>
                        <p>Abfahrt</p>
                        <p id="delay<?php echo $i ?>" class="delay"></p>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div id="errorField" style="display: none;">
            <h1 style="color: red;">Uuups! Etwas ist schief gelaufen.</h1>
            <p></p>
        </div>
    </main>
</body>
</html>