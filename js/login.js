function process(form){
    let formData = new FormData(form);
    console.log(formData);
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