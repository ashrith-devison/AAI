function validate(){
    const credentials = {
        userid : document.getElementById('username').value,
        passkey : document.getElementById('passkey').value
    };
    console.log(credentials);

    fetch('/AAI/login/login-verify.php',{
        method : 'POST',
        headers : {
            'Content-Type' : 'application/json'
        },
        body : JSON.stringify(credentials)
    }).then(response => {
        if(!response.ok){
            console.error("Internal Server Occured");
        }
        return response.json();
    }).then(data => {
        console.log(data);  
        if(data.url){
            const user_data = {
                userid : data.userid
            };
            fetch(data.url, {
                method : 'POST',
                headers : {
                    'Content-Type' : 'application/json'
                },
                body : JSON.stringify(user_data)
            })
            .then(response => {
                if(!response.ok){
                    console.error("Internal Server Error 404 - Home");
                }
                return response.text();
            }).then(page_date => {
                document.write(page_date);
            })
        }
    })
    return false;
}