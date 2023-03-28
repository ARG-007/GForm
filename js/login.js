function log(form){
    let formData = new FormData(form);

    $.ajax({
        url: "php/login.php",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: (response) => console.log(response),
        error: (error) => console.log(error),
    });
}