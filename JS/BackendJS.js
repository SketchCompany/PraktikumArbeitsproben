function NextPage() {
    if (BackendZahl + 1 != Backendfields.length) {
        BackendZahl += 1;
        for (let i = 0; i < Backendfields.length; i++) {
            $(Backendfields[i]).css("display", "none");
        }

        $(Backendfields[BackendZahl]).css("display", "block");
    } else {
        BackendZahl = 0;
        for (let i = 0; i < Backendfields.length; i++) {
            $(Backendfields[i]).css("display", "none");
        }

        $(Backendfields[BackendZahl]).css("display", "block");
    }
}

function PrevPage() {
    if (BackendZahl - 1 >= 0) {
        BackendZahl -= 1;
        for (let i = 0; i < Backendfields.length; i++) {
            $(Backendfields[i]).css("display", "none");
        }

        $(Backendfields[BackendZahl]).css("display", "block");
    } else {
        BackendZahl = Backendfields.length - 1;
        for (let i = 0; i < Backendfields.length; i++) {
            $(Backendfields[i]).css("display", "none");
        }

        $(Backendfields[BackendZahl]).css("display", "block");
    }
}

function test(Project) {
    var Name = $('#ProjectList option:selected').text();
    var ID = $("#ProjectList").val() - 1
    console.log(Name)
    console.log(ID)
    console.log(Project)

    if (ID == -1) {
        $("#BackendTitle").val("")
        $("#BackendYear").val("")
        $("#BackendLink").val("")
        $("#BackendDescription").val("")
        $("#BackendIMG").val("")
    }
    else {
        $("#BackendTitle").val(Project[ID]["Name"])
        $("#BackendYear").val(Project[ID]["Year"])
        $("#BackendLink").val(Project[ID]["Link"])
        $("#BackendDescription").val(Project[ID]["Description"])
        $("#BackendIMG").val(Project[ID]["Image"])
    }
}