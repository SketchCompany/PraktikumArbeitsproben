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

<script>
    const params = new URL(location.href).searchParams
    const tripId = encodeURI(params.get("tripId"))
    console.log("tripId:", tripId)

    function callAPI(){
        return $.ajax({
            url: '../XML/BackendTripAPI.php', // Your PHP script URL
            type: 'POST',
            data: { tripId }, // Send the selected value as 'stations' in POST data
        });
    }
    
    async function getTrip(){
        apiResponse = JSON.parse(await callAPI())
        console.log(apiResponse)

        document.title = apiResponse.direction + " | Bugehagenwerk - IT Ausbildung"
        $("#tripOrigin").text(apiResponse.origin.name)
        $("#tripName").text(apiResponse.direction)
        $("#tripNumber").text(apiResponse.line.fahrtNr)
        $("#tripArrival").text(apiResponse.arrival.toString().substring(11).substring(0, 5))
        $("#tripDeparture").text(apiResponse.departure.toString().substring(11).substring(0, 5))

        if(apiResponse.departureDelay && (apiResponse.departureDelay / 60) >= 1){
            $("#tripArrivalDelay").text((apiResponse.arrivalDelay / 60) + " min Verspätung")
        }
        else{
            $("#tripArrivalDelay").html("")
        }
        if(apiResponse.departureDelay && (apiResponse.departureDelay / 60) >= 1){
            $("#tripDepartureDelay").text((apiResponse.departureDelay / 60) + " min Verspätung")
        }
        else{
            $("#tripDepartureDelay").html("")
        }


        // if(apiResponse.line.mode == "train"){
        //     $("#tripArrivalPlatform").text("Gleis " + apiResponse.arrivalPlatform)
        //     $("#tripDeparturePlatform").text("Gleis " + apiResponse.departurePlatform)
        // }
        // else{
        //     $("#tripArrivalPlatform").parent().css("display", "none")
        //     $("#tripDeparturePlatform").parent().css("display", "none")
        // }


        if(apiResponse.line.mode == "bus"){
            $("#tripLineName").text(apiResponse.line.name.substring(3).replace(/\s/g, ""))
            $("#tripLineType").text("Bus")
        }
        else if(apiResponse.line.mode == "watercraft"){
            $("#tripArrivalPlatform").text("Steg " + apiResponse.arrivalPlatform)
            $("#tripDeparturePlatform").text("Steg " + apiResponse.departurePlatform)
            $("#tripLineType").text("Fähre")
            $("#tripLineName").text(apiResponse.line.name)
        }
        else if(apiResponse.line.name.includes("U ")){
            $("#tripArrivalPlatform").parent().css("display", "none")
            $("#tripDeparturePlatform").parent().css("display", "none")
            $("#tripLineName").text(apiResponse.line.name)
            $("#tripLineType").text("Zug")
        }
        //SEV
        else if(apiResponse.line.name.includes("Bus")){
            $("#tripArrivalPlatform").parent().css("display", "none")
            $("#tripDeparturePlatform").parent().css("display", "none")
            $("#tripLineName").text(apiResponse.line.name.substring(3).replace(/\s/g, ""))
            $("#tripLineType").text("Bus")
            apiResponse.line.mode = "bus"
        }
        else{
            $("#tripLineName").text(apiResponse.line.name)
            $("#tripLineType").text("Zug")
        }
        
        if(!apiResponse.line.operator) apiResponse.line.operator = ""
        switch (apiResponse.line.operator.id){
            case "db-regio-ag-nord":
                $("#toppic").attr("src", "../IMG/Logos/dbLogo.png")
            break;
            case "db-fernverkehr-ag":
                $("#toppic").attr("src", "../IMG/Logos/iceLogo.png")
            break;
            case "erixx":
                $("#toppic").attr("src", "../IMG/Logos/erixxLogo.png")
            break;
            case "autokraft":
                $("#toppic").attr("src", "../IMG/Logos/autokraftLogo.png")
            break;
            case "nordbahn" :
                $("#toppic").attr("src", "../IMG/Logos/nordbahnLogo.png")
            break;
            case "s-bahn-hamburg":
                $("#toppic").attr("src", "../IMG/Logos/sBahnLogo.png")
            break;
            case "metronom":
                $("#toppic").attr("src", "../IMG/Logos/metronomLogo.png")
            break;
            case "nahreisezug":
                switch (apiResponse.line.adminCode){
                    case "ak_SVL":
                        $("#toppic").attr("src", "../IMG/Logos/svlLogo.png")
                    break;
                    case "hvvhha":
                        $("#toppic").attr("src", "../IMG/Logos/hvvLogo.png")
                    break;
                    case "hvvHHA":
                        $("#toppic").attr("src", "../IMG/Logos/hvvLogo.png")
                    break;
                    case "hvvVHH":
                        $("#toppic").attr("src", "../IMG/Logos/hvvLogo.png")
                    break;
                    case "hvv001": //U-Bahn
                        $("#toppic").attr("src", "../IMG/Logos/hochbahnLogo.png")
                    break;
                    case "akKVGK":
                        $("#toppic").attr("src", "../IMG/Logos/kvgLogo.png")
                    break;
                    case "ak_VKP":
                        $("#toppic").attr("src", "../IMG/Logos/vkpLogo.png")
                    break;
                    case "ak_AK_":
                        $("#toppic").attr("src", "../IMG/Logos/autokraftLogo.png")
                    break;
                    case "akSFKK":
                        $("#toppic").attr("src", "../IMG/Logos/sfkLogo.png")
                    break;

                }
            break;
            default:
                switch (apiResponse.line.adminCode){
                    case "ak_SVL":
                        $("#toppic").attr("src", "../IMG/Logos/svlLogo.png")
                    break;
                    case "hvvhha":
                        $("#toppic").attr("src", "../IMG/Logos/hvvLogo.png")
                    break;
                    case "hvvHHA":
                        $("#toppic").attr("src", "../IMG/Logos/hvvLogo.png")
                    break;
                    case "hvvVHH":
                        $("#toppic").attr("src", "../IMG/Logos/hvvLogo.png")
                    break;
                    case "hvv001": //U-Bahn
                        $("#toppic").attr("src", "../IMG/Logos/hochbahnLogo.png")
                    break;
                    case "akKVGK":
                        $("#toppic").attr("src", "../IMG/Logos/kvgLogo.png")
                    break;
                    case "ak_VKP":
                        $("#toppic").attr("src", "../IMG/Logos/vkpLogo.png")
                    break;
                    case "ak_AK_":
                        $("#toppic").attr("src", "../IMG/Logos/autokraftLogo.png")
                    break;
                    case "akSFKK":
                        $("#toppic").attr("src", "../IMG/Logos/sfkLogo.png")
                    break;

                }
        }
        for (let i = 0; i < apiResponse.stopovers.length; i++) {
            const element = apiResponse.stopovers[i]
            const correct = $.extend({}, apiResponse.stopovers[i])

            console.log("correct: ", correct)
            console.log("stopover: ", element)

            if(!element.arrival){
                if(!element.plannedArrival){
                    correct.arrival = "Nicht bekannt"
                }
                else{
                    console.log("using planned arrival")
                    correct.arrival = element.plannedArrival.toString().substring(11).substring(0, 5)
                }
            }
            else{
                correct.arrival = correct.arrival.toString().substring(11).substring(0, 5)
            }
            if(!element.departure){
                if(!element.plannedDeparture){
                    correct.departure = "Nicht bekannt"
                }
                else{
                    console.log("using planned arrival")
                    correct.departure = element.plannedDeparture.toString().substring(11).substring(0, 5)
                }
            }
            else{
                correct.departure = correct.departure.toString().substring(11).substring(0, 5)
            }
            if(!element.departurePlatform){
                if(!element.plannedDeparturePlatform){
                    correct.departurePlatform = "Nicht bekannt"
                }
                else{
                    correct.departurePlatform = "Gleis " + element.plannedDeparturePlatform
                }
            }
            else{
                correct.departurePlatform = "Gleis " + element.departurePlatform
            }

            if(element.arrivalDelay == null || element.arrivalDelay == 0){
                console.log("no arrivalDelay")
                correct.arrivalDelay = 0
            }
            else{
                correct.arrivalDelay = element.arrivalDelay / 60
            }

            if(element.departureDelay == null || element.departureDelay == 0){
                console.log("no departureDelay")
                correct.departureDelay = 0
            }
            else{
                correct.departureDelay = element.departureDelay / 60
            }

            $(".stopovers").append(`
            
            <div id="stopover`+i+`" class="stopover">
                <div class="crow">
                    <div class="ccolumn">
                        <p>Name</p>
                        <h3 id="tripStopoverName`+i+`" class="target">`+ element.stop.name +`</h3>
                    </div>
                    <div class="ccolumn">
                        <p>Abfahrt von</p>
                        <h3 id="tripStopoverDeparturePlatform`+i+`" class="platform">` + correct.departurePlatform + `</h3>
                    </div>
                </div>
                <div class="crow">
                    <div class="ccolumn">
                        <p>Ankunft</p>
                        <h3 id="tripStopoverArrival`+i+`">` + correct.arrival + `</h3>
                        <p id="tripStopoverArrivalDelay`+i+`" class="delay">` + correct.arrivalDelay + ` min Verspätung</p>
                    </div>
                    <div class="ccolumn">
                        <p>Abfahrt</p>
                        <h3 id="tripStopoverDeparture`+i+`">` + correct.departure + `</h3>
                        <p id="tripStopoverDepartureDelay`+i+`" class="delay">` + correct.departureDelay + ` min Verspätung</p>
                    </div>
                </div>
            </div>
            <div id="tripStopoverArrowIcon`+i+`" class="bi bi-arrow-down" style="font-size: 30px;"></div>
            
            `)

            if(element.arrivalDelay < 1) $("#tripStopoverArrivalDelay" + i).html("")
            if(element.departureDelay < 1) $("#tripStopoverDepartureDelay" + i).html("")
            if(element.arrival == "Nicht bekannt") $("#tripStopoverArrival" + i).parent().css("display", "none")

            if(i == 0){
                $("#tripStopoverArrival" + i).parent().css("opacity", "0")
            }

            if(i + 1 == apiResponse.stopovers.length){
                $("#tripStopoverArrowIcon" + i).css("display", "none")
                $("#tripStopoverDeparture" + i).parent().css("opacity", "0")
                $("#tripStopoverDeparturePlatform" + i).parent().css("opacity", "0")
            } 
            if(apiResponse.line.mode == "bus"){
                $("#tripStopoverDeparturePlatform" + i).text("Haltestelle")
            }
            else if(apiResponse.line.mode == "watercraft"){
                $("#tripStopoverDeparturePlatform" + i).text("Hafen")
            }
        }


    }

    $(document).ready(function(){
        getTrip()
    })
</script>
</body>
</html>