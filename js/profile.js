console.log($('#profileForm')[0],typeof($('#profileForm')));

$.ajax({
    url: "php/profile.php",
    type: "POST",
    data: {"REQUEST":"FORM_GET","SessionID":window.localStorage.getItem("SessionID")},
    success: processResponse,
    error: (error)=>console.log(error)
});

function processResponse(content){
    console.log(content);
    if(content==="SESSION_INVALID"){
        location.href="login.html";
    }
    content = JSON.parse(content);

    let form = $('#profileForm')[0];
    delete content["_id"];
    for(let input in content){
        form[input].value=content[input];
    }
}

function updateDB(form){
    let formData=new FormData(form);
    formData.append("REQUEST","FORM_PUT");
    formData.append("SessionID",window.localStorage.getItem("SessionID")    );
    $.ajax({
        type: "POST",
        url: "php/profile.php",
        data: formData,
        processData: false,
        contentType: false,
        success: (data)=>console.log(data),
        error: (data)=>console.log(data),
    })
}