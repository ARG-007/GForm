const getDB = () => fetch("php/testDB.php",{
        headers: {
            'content-type': 'text/html',
            'accept': 'text/html',
        },
    })
.then(res => res.text())
.then(result => $('body').html(result));