function process(form){
    let formData = new FormData(form);
    console.log(formData);
    // $.post("php/register.php",formData,(response)=>console.log(response),"JSON");
    $.ajax({
        url: "php/register.php",
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
        case "USER_EXISTS": 
            $("#emailInvalid").html("User Already Exists! <a href='login.html'>Log In</a> Instead");
            $("#emailBox").addClass("is-invalid");
            break;
        default :
            window.localStorage.setItem("SessionID",response.trim());
            location.href="profile.html";
    }
}