function BackendDeletePerson() {
    var SelectedId = $('#PeopleList').val();
    $.ajax({
        url: '../XML/BackendDeletePerson.php',
        type: 'POST',
        data: { ID: SelectedId },
        success: function () {
            window.location.reload();
        }
    });
}

function BackendAddPerson() {
    var LastName = $('#BackendLastName').val();
    var FirstName = $('#BackendFirstName').val();
    var IMG = $('#BackendSCPBL')[0].files[0];

    console.log(IMG)

    var formData = new FormData();
    formData.append('IMG', IMG);
    formData.append('LastName', LastName);
    formData.append('FirstName', FirstName);

    $.ajax({
        url: '../XML/BackendAddPerson.php',
        type: 'POST',
        data: formData,
        success: function (response) {
            console.log('Server response:', response);
            $('#BackendLastName').val("");
            $('#BackendFirstName').val("");
            $('#BackendSCPBL').val("");
            $('#PeopleList').val("");
            window.location.reload();
        },
        error: function (xhr, status, error) {
            console.error("An error occurred:", error);
            console.log("XHR object:", xhr);
            console.log("Status:", status);
        },
        processData: false,
        contentType: false,
    });
}

function BackendPlusOne() {
    var SelectedId = $('#PeopleList').val();
    $.ajax({
        url: '../XML/BackendPlusOne.php',
        type: 'POST',
        data: { ID: SelectedId },
        success: function () {
            $('#BackendLastName').val("");
            $('#BackendFirstName').val("");
            $('#BackendSCPBL').val("");
            $('#PeopleList').val("");
            window.location.reload();
        }
    });
}

function BackendAddProject() {
    var Title = $('#BackendTitle').val();
    var Year = $('#BackendYear').val();
    var Link = $('#BackendLink').val();
    var Desc = $('#BackendDescription').val();
    var IMG = $('#BackendIMG')[0].files[0];

    var formData = new FormData();
    formData.append('Title', Title);
    formData.append('Year', Year);
    formData.append('Link', Link);
    formData.append('Desc', Desc);
    formData.append('IMG', IMG);

    $.ajax({
        url: '../XML/BackendAddProject.php',
        type: 'POST',
        data: formData,
        success: function (response) {
            console.log('Server response:', response);
            $('#BackendTitle').val("");
            $('#BackendYear').val("");
            $('#BackendLink').val("");
            $('#BackendDescription').val("");
            $('#BackendIMG').val("");
            window.location.reload();
        },
        error: function (xhr, status, error) {
            console.error("An error occurred:", error);
            console.log("XHR object:", xhr);
            console.log("Status:", status);
        },
        processData: false,
        contentType: false,
    });
}

function BackendDelProject() {
    var Title = $('#ProjectList option:selected').text();
    $.ajax({
        url: '../XML/BackendDelProject.php',
        type: 'POST',
        data: { Title: Title },
        success: function (response) {
            console.log('Server response:', response);
            $('#BackendTitle').val("");
            $('#BackendYear').val("");
            $('#BackendLink').val("");
            $('#BackendDescription').val("");
            $('#BackendIMG').val("");
            window.location.reload();
        }
    });
}

