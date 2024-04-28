var BackendZahl = 0;
const Backendfields = ['#BackendPeople', '#BackendProject']

function setHeader(){
    document.querySelector("body").insertAdjacentHTML("beforeend", `
<footer>
    <p>
        <span class="bi bi-c-circle" style="font-size: 14px"></span>
        <a href="https://bugenhagen.de" target ='_blank'>Bugenhagenwerk</a> |
        <a href="https://www.facebook.com/dasbbw/?locale=de_DE" target ='_blank'>Facebook</a> |
        <a href="https://de.wikipedia.org/wiki/Bugenhagen_Berufsbildungswerk" target ='_blank'>Wikipedia</a>
    </p>
</footer>
    `)

    if(document.body.clientWidth < 775){
        document.querySelector(".right").style.display = "none"
        document.querySelector(".list").style.display = "block"
    }
    else{
        document.querySelector(".right").style.display = "flex"
        document.querySelector(".list").style.display = "none"
    }
    window.addEventListener("resize", () => {
        if(document.body.clientWidth < 775){
            document.querySelector(".right").style.display = "none"
            document.querySelector(".list").style.display = "block"
        }
        else{
            document.querySelector(".right").style.display = "flex"
            document.querySelector(".list").style.display = "none"
            document.querySelector(".header-dropdown").style.display = "none"
        }
    })

    document.querySelector(".list").addEventListener("click", () => {
        if(document.querySelector(".header-dropdown").style.display == "flex"){
            document.querySelector(".header-dropdown").style.display = "none"
        }
        else{
            document.querySelector(".header-dropdown").style.display = "flex"
        }
    })

    if(location.pathname == "/Ausbildungsseite/PHP/DeutscheBahn.php" || location.pathname == "/Ausbildungsseite/PHP/DeutscheBahn2.php"){
        document.getElementById("headerTitle").innerHTML = "Verfügbare Verbindungen"
    }
    else if(location.pathname == "/Ausbildungsseite/PHP/Team.php"){
        document.getElementById("headerTitle").innerHTML = "Das Team"
    }

    const buttons = document.querySelectorAll(".navigation > div > .options > button")
    buttons.forEach(element => {
        element.addEventListener("click", () => {
            if(document.querySelector(".active")){
                document.querySelector(".active").classList.remove("active")
            }
            if(element.classList.contains("active")){
                element.classList.remove("active")
            }
            else{
                element.classList.add("active")
            }
        })
    })
}

function openLink(link, target){
    const a = document.createElement("a")
    a.href = link
    if(target) a.target = target
    a.click()
}

$(document).ready(function () {
    setHeader()
})