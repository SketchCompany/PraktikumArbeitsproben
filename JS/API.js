var lastCheck = 0;
var checked = false
let dbAll = Array();
async function test() {
    const tbChecks = 15
    if (Math.floor((new Date() - lastCheck) / 1000) < tbChecks ) {
        console.log("last check was not less than ", tbChecks, "seconds ago, please wait")
        return
    }
    let stationNr =document.getElementById("stations").value
    let apiUrl = 'https://v6.db.transport.rest/stops/'+stationNr+'/departures?duration=600&linesOfStops=false&remarks=true&language=en';
    let ausprobieren;
    try {
        let apiPromise = await fetch(apiUrl);
        let apiResponse = await apiPromise.json();
        console.log("apiResponse:", apiResponse);
        ausprobieren = apiResponse
        lastCheck = new Date();
    } catch (error) {
        console.error('Oops, something went wrong:', error)
        $(".connections").css("display", "none")
        $(".headline").css("display", "none")
        $(".navigation").css("display", "none")
        $(".filter").css("display", "none")
        $("#errorField").css("display", "block")
        $("#errorField > p").text(error.toString())
    }
    let apiResponse = ausprobieren.departures
    let dbTrains = Array();
    let dbBuses = Array();
    dbAll = Array();

    for (let i = 0; i < apiResponse.length; i++) {
        var temp = Array(12);
        if (apiResponse[i].prognosedPlatform == undefined) {
            temp[0]=apiResponse[i].plannedPlatform;
        }
        else{
            temp[0]=apiResponse[i].prognosedPlatform;
        }
        if( temp[0]==null){
            temp[0]="1"
        }
        temp[1]=apiResponse[i].line.name;
        temp[2]=apiResponse[i].direction;
        temp[3]=apiResponse[i].plannedWhen;
        //temp[3]= "2024-03-20T14:00:00+01:00";
        if (apiResponse[i].delay==null){
            temp[4]= 0
        } else {
            temp[4]= apiResponse[i].delay / 60
        }
        if (apiResponse[i].cancelled !== undefined){
            temp[5]=apiResponse[i].cancelled
        } else if(apiResponse[i].remarks.code == "journey-cancelled"){
            temp[5] = true
        } else{
            temp[5] = false
        }
        if (apiResponse[i].prognosedWhen == undefined) {
            temp[6]=null;
        }
        else {
            temp[6]=apiResponse[i].prognosedWhen;
        }
        temp[7]=apiResponse[i].line.mode
        temp[8]=apiResponse[i].line.fahrtNr
        temp[9]=apiResponse[i].stop.name
        temp[10]=apiResponse[i].tripId
        if(!apiResponse[i].line.operator) apiResponse[i].line.operator = ""
        switch (apiResponse[i].line.operator.id){
            case "db-regio-ag-nord":
                temp[11]="../IMG/Logos/dbLogo.png"
            break;
            case "db-fernverkehr-ag":
                temp[11]="../IMG/Logos/iceLogo.png"
            break;
            case "erixx":
                temp[11]="../IMG/Logos/erixxLogo.png"
            break;
            case "autokraft":
                temp[11]="../IMG/Logos/autokraftLogo.png"
            break;
            case "nordbahn" :
                temp[11]="../IMG/Logos/nordbahnLogo.png"
            break;
            case "s-bahn-hamburg":
                temp[11]="../IMG/Logos/sBahnLogo.png"
            break;
            case "metronom":
                temp[11]="../IMG/Logos/metronomLogo.png"
            break;
            case "nahreisezug":
                switch (apiResponse[i].line.adminCode){
                    case "ak_SVL":
                        temp[11]="../IMG/Logos/svlLogo.png"
                    break;
                    case "hvvhha":
                        temp[11]="../IMG/Logos/hvvLogo.png"
                    break;
                    case "hvvHHA":
                        temp[11]="../IMG/Logos/hvvLogo.png"
                    break;
                    case "hvvVHH":
                        temp[11]="../IMG/Logos/hvvLogo.png"
                    break;
                    case "hvv001": //U-Bahn
                        temp[11]="../IMG/Logos/hochbahnLogo.png"
                    break;
                    case "akKVGK":
                        temp[11]="../IMG/Logos/kvgLogo.png"
                    break;
                    case "ak_VKP":
                        temp[11]="../IMG/Logos/vkpLogo.png"
                    break;
                    case "ak_AK_":
                        temp[11]="../IMG/Logos/autokraftLogo.png"
                    break;
                    case "akSFKK":
                        temp[11]="../IMG/Logos/sfkLogo.png"
                    break;
                }
            break;
        }

        if (temp[7]=="bus") {
            dbBuses.push(temp);
        } else if (temp[7]=="train") {
            dbTrains.push(temp);
        }
        dbAll.push(temp)
    }

    dbAll.sort((a, b) => {
        return Date.parse(a[3]) - Date.parse(b[3])
    })
    dbTrains.sort((a, b) => {
        return Date.parse(a[3]) - Date.parse(b[3])
    })
    dbBuses.sort((a, b) => {
        return Date.parse(a[3]) - Date.parse(b[3])
    })

    const connectionsCount = 50

    for(let index = 0; index < connectionsCount; index++){
        if($("#Tconnection" + index).hasClass("connection-canceled")){
            $("#Tconnection" + index).removeClass("connection-canceled")
            $("#Tdelay" + index).css("display", "none")
            $("#Tdelay" + index).text("")
            $("#Ttarget" + index).css("color", "rgb(250, 160, 0)")
            $("#Tplatform" + index).css("color", "rgb(0, 100, 255)")
        }
        if($("#Bconnection" + index).hasClass("connection-canceled")){
            $("#Bconnection" + index).removeClass("connection-canceled")
            $("#Bdelay" + index).css("display", "none")
            $("#Bdelay" + index).text("")
            $("#Btarget" + index).css("color", "rgb(250, 160, 0)")
            $("#Bplatform" + index).css("color", "rgb(0, 100, 255)")
        }
        $("#Bicon" + index).removeAttr("src")
        $("#Ticon" + index).removeAttr("src")
    }
    for(let index = 0; index < connectionsCount; index++){
        if($("#connection" + index).hasClass("connection-canceled")){
            $("#connection" + index).removeClass("connection-canceled")
            $("#delay" + index).css("display", "none")
            $("#delay" + index).text("")
            $("#target" + index).css("color", "rgb(250, 160, 0)")
            $("#platform" + index).css("color", "rgb(0, 100, 255)")
        }
        $("#icon" + index).removeAttr("src")
    }

    if(dbTrains.length < connectionsCount){
        for(let index = dbTrains.length; index < connectionsCount; index++){
            $("#Tconnection" + index).css("display", "none")
        }
    }
    else{
        for(let index = 0; index < connectionsCount; index++){
            $("#Tconnection" + index).css("display", "flex")
        }
    }

    if(dbBuses.length < connectionsCount){
        for(let index = dbBuses.length; index < connectionsCount; index++){
            $("#Bconnection" + index).css("display", "none")
        }
    }
    else{
        for(let index = 0; index < connectionsCount; index++){
            $("#Bconnection" + index).css("display", "flex")
        }
    }

    if(dbAll.length < connectionsCount){
        for(let index = dbAll.length; index < connectionsCount; index++){
            $("#connection" + index).css("display", "none")
        }
    }
    else{
        for(let index = 0; index < connectionsCount; index++){
            $("#connection" + index).css("display", "flex")
        }
    }

    for (let index = 0; index < dbTrains.length; index++) {

        // dbTrains[index][0]
        let time = dbTrains[index][3].toString().substring(11).substring(0, 5)
        $('#Tdeparture'+ index).text(time)
        let target = dbTrains[index][2]

        $('#Ttarget' + index).text(target)

        if(dbTrains[index][4] != null && dbTrains[index][4] > 0){
            $("#Tdelay" + index).text(dbTrains[index][4] + " min Verspätung")
            if(dbTrains[index][6] != null)
            {
                $('#Tdeparture'+ index).text(dbTrains[index][6].toString().substring(11, 16))
                $("#Tplanned" + index).text(dbTrains[index][3])
            }
            else{
                $("#Tplanned" + index).css("display", "none")
            }
        }
        else{
            $("#Tdelay" + index).css("display", "none")
            $("#Tplanned" + index).css("display", "none")
        }

        if(dbTrains[index][5] == true){
            $("#Tdelay" + index).css("display", "flex")
            $("#Tdelay" + index).text("Fällt aus")
            $("#Tconnection" + index).addClass("connection-canceled")
            $("#Ttarget" + index).css("color", "var(--clr-hover)")
            $("#Tplatform" + index).css("color", "var(--clr-hover)")
        }
        else{
            $("#Tconnection" + index).click(function(){
                openLink("./Trip.php?tripId=" + dbTrains[index][10])
            })
        }

        $('#Tplatform' + index).text('Gleis ' + dbTrains[index][0]);
        $('#Ttrain' + index).text(dbTrains[index][1]);

        if(dbTrains[index][8]) $("#Tnumber" + index).text("Fahrt: " + dbTrains[index][8])
        if(dbTrains[index][9]){
            $("#Tsection" + index).text(dbTrains[index][9].split(",")[0])
        }
        else{
            console.log("no section was found")
        }

        $("#Ticon" + index).attr("src", dbTrains[index][11])
    }

    console.log("dbTrains:", dbTrains);

    for (let index = 0; index < dbBuses.length; index++) {
        // dbBuses[index][0]
        let time

        time = dbBuses[index][3].toString().substring(11).substring(0, 5)
        $('#Bdeparture'+ index).text(time)

        let target = dbBuses[index][2]

        $('#Btarget' + index).text(target)

        if(dbBuses[index][4] != null && dbBuses[index][4] > 0){
            $("#Bdelay" + index).text(dbBuses[index][4] + " min Verspätung")
            if(dbBuses[index][6] != null)
            {
                $('#Bdeparture'+ index).text(dbBuses[index][6].toString().substring(11, 16))
                $("#Bplanned" + index).text(dbBuses[index][3])
            }
            else{
                $("#Bplanned" + index).css("display", "none")
            }
        }
        else{
            $("#Bdelay" + index).css("display", "none")
            $("#Bplanned" + index).css("display", "none")
        }

        if(dbBuses[index][5] == true){
            $("#Bdelay" + index).css("display", "flex")
            $("#Bdelay" + index).text("Fällt aus")
            $("#Bconnection" + index).addClass("connection-canceled")
            $("#Btarget" + index).css("color", "var(--clr-hover)")
            $("#Bplatform" + index).css("color", "var(--clr-hover)")
        }
        else{
            $("#Bconnection" + index).click(function(){
                openLink("./Trip.php?tripId=" + dbBuses[index][10])
            })
        }

        $('#Bplatform' + index).text(dbBuses[index][1].substring(0, 3).replace(/\s/g, ""));
        $('#Btrain' + index).text(dbBuses[index][1].substring(3).replace(/\s/g, ""));

        if(dbBuses[index][8]) $("#Bnumber" + index).text("Fahrt: " + dbBuses[index][8])
        if(dbBuses[index][9]){
            $("#Bsection" + index).text(dbBuses[index][9].split(",")[0])
        }
        else{
            console.log("no section was found")
        }

        $("#Bicon" + index).attr("src", dbBuses[index][11])
    }

    console.log("dbBusses:", dbBuses);

    for (let index = 0; index < dbAll.length; index++) {
        // dbAll[index][0]
        let time

        time = dbAll[index][3].toString().substring(11).substring(0, 5)
        $('#departure'+ index).text(time)

        let target = dbAll[index][2]

        $('#target' + index).text(target)

        if(dbAll[index][4] !== null && dbAll[index][4] > 0){
            $("#delay" + index).text(dbAll[index][4] + " min Verspätung")
            if(dbAll[index][6] != null)
            {
                $('#departure'+ index).text(dbAll[index][6].toString().substring(11, 16))
                $("#planned" + index).text(time)
            }
            else{
                $("#planned" + index).css("display", "none")
            }
        }
        else{
            $("#delay" + index).css("display", "none")
            $("#planned" + index).css("display", "none")
        }

        if(dbAll[index][5] == true){
            $("#delay" + index).css("display", "flex")
            $("#delay" + index).text("Fällt aus")
            $("#connection" + index).addClass("connection-canceled")
            $("#target" + index).css("color", "var(--clr-hover)")
            $("#platform" + index).css("color", "var(--clr-hover)")
        }
        else{
            $("#connection" + index).click(function(){
                openLink("./Trip.php?tripId=" + dbAll[index][10])
            })
        }

        if(dbAll[index][7] == "train"){
            $('#platform' + index).text('Gleis ' + dbAll[index][0]);
            $('#train' + index).text(dbAll[index][1]);
        }
        else if(dbAll[index][7] == "bus"){
            $('#platform' + index).text(dbAll[index][1].substring(0, 3).replace(/\s/g, ""));
            $('#train' + index).text(dbAll[index][1].substring(3).replace(/\s/g, ""));
        }
        else if(dbAll[index][7] == "watercraft"){
            $("#platform" + index).text("Steg " + dbAll[index][0])
        }

        if(dbAll[index][8]) $("#number" + index).text("Fahrt: " + dbAll[index][8])
        if(dbAll[index][9]){
            $("#section" + index).text(dbAll[index][9].split(",")[0])
        }
        else{
            console.log("no section was found")
        }

        $("#icon" + index).attr("src", dbAll[index][11])
    }

    console.log("dbAll:", dbAll);
    console.log("lastCheck:", lastCheck)

    console.log("1time:", new Date(Date.parse(dbAll[0][3])).toString())
    console.log("2time:", new Date(Date.parse(dbAll[0][3]) + 120000).toString())
    console.log("3time:", Math.floor(new Date(Date.parse(dbAll[0][3]) + 120000)))
    console.log("4time:", Date.now())
}

$(document).ready(function () {
    test()
    startCheck()
    addEventListeners()
});

var lastClicked = "8005874"
function addEventListeners(){
    const options = document.getElementById("stations").children
    for(let i = 0; i < options.length; i++){
        options[i].addEventListener("click", () => {
            if(lastClicked != options[i].value){
                lastClicked = options[i].value
                lastCheck = 0
                test()
            }
            else console.log("already shown")
        })
    }
}

function startCheck(){
    setTimeout(() => {
        if(Math.floor(new Date(Date.parse(dbAll[0][3]) + 120000)) < Date.now()){
            console.log("5time:", true)
            console.log("6time: Der ", dbAll[0][7].substring(0, 1).toUpperCase() + dbAll[0][7].substring(1), " nach ", dbAll[0][2], " ist um ", dbAll[0][3].substring(11).substring(0, 5), " Uhr abgefahren. Ausgeführt um ", new Date().toTimeString().substring(0, 5))
            test()
        }
        else{
            console.log("5time:", false)
        }
        startCheck()
    }, 30000)
}

function openTrain(){
    $("#train").css("display", "flex")
    $("#bus").css("display", "none")
    $("#all").css("display", "none")
}

function openBus(){
    $("#train").css("display", "none")
    $("#bus").css("display", "flex")
    $("#all").css("display", "none")
}

function openAll(){
    $("#bus").css("display", "none")
    $("#train").css("display", "none")
    $("#all").css("display", "flex")
}

// Gleis |Name |Ziel |abfahrt |verspätung |fällt aus| neu ankunft |mode |ZugNr| Bahnhofs Abschnitt
