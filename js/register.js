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
        success: (response) => console.log(response),
        error: (error) => console.log(error),
    });

}