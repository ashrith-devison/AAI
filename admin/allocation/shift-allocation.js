
function update(element){
    var updateValue = element.value;
    var empId = element.getAttribute('data-id');
    console.log(updateValue+empId);

    const data = {
        empId : empId,
        status : updateValue,
        deptId : document.getElementById('department-selection').value
    };

    fetch('/AAI/admin/allocation/update.php', {
        method : 'POST',
        headers : {
            'Content-Type' : 'application/json'
        },
        body : JSON.stringify(data)
    }).then(response => {
        if(!response.ok){
            console.error("Internal Server Error");
        }
        return response.text()
    }).then(data =>{
        console.log(data);
    })
    return false;
}


function relocate(path){
    window.location.href = path;
}