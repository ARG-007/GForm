function process(form){
    let formData = new FormData(form);
    formData.append("REQUEST","LOGIN");
    $.ajax({
        url: "php/login.php",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: processResponse,
        error: (error) => console.log(error),
    });
}

function processResponse(response){
    console.log(response);
    switch(response){
        case "SERVER_ERROR" : return;
        case "USER_NOT_EXISTS": 
            $("#emailInvalid").html("User Doesn't Exists! <a href='register.html'>Register</a> Instead");
            $("#emailBox").addClass("is-invalid");
            break;
        case "USER_ENTERED_NCP":
            $("#password").addClass("is-invalid");
            break;
        default : 
            window.localStorage.setItem("SessionID",response.trim());
            location.href = "profile.html";
    }
}


if(window.localStorage.getItem("SessionID")){
    $.ajax({
        url: "php/login.php",
        type: "POST",
        data: {"REQUEST":"ValidateSession","SessionToken":window.localStorage.getItem("SessionID")},
        success: (response) => (response==="Session_Valid")?window.location="profile.html":window.localStorage.setItem("SessionID",null),
        error: (error) => console.log(error),
    });
}