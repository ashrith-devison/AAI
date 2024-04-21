function fetch_allocation_data(){
    const user_data = {
        userid : document.getElementById('UserId').innerText,
        departmentId : document.getElementById('department-selection').value
    };
    document.getElementById('shift-form').style.display = "none";
    console.log(user_data);
    var existingScript = document.querySelector('script[src="/AAI/admin/allocation/shift-allocation.js"]');
    if (existingScript) {
        console.log("Success");
    }
    else{
        var script = document.createElement('script');
        script.src = "/AAI/admin/allocation/shift-allocation.js";
        script.defer = true;
        var targetScript = document.getElementById('script-record');
        targetScript.append(script);
    }
    if(!verify_path(user_data)){
        return;
    }
    else{
        fetch('/AAI/admin/allocation/allocation.php', {
            method : 'POST',
            headers : {
                'Content-Type' : 'application/json'
            },
            body : JSON.stringify(user_data)
        }).then(response => {
            if(!response.ok){
                console.error("Internal Server Error 404 - Allocation Fetch");
            }
            return response.text();
        }).then(data => {
            var showDiv = document.getElementById('request-table');
            showDiv.style.display = "block";
            document.getElementById('request-table').innerHTML = data;
        });
    }
}

function fetch_result_data(){
    document.getElementById('shift-form').style.display = "block";
    document.getElementById('request-table').style.display = "none";
}

function verify_path(user_data){
    if(user_data.userid == ""){
        Swal.fire({
            title: 'Ilegal Access',
            text: 'You need to login to access this content',
            icon: 'warning',
            confirmButtonText: 'Okay'
          }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "/AAI/index.html";
                return false;
            }
          });
        return false;
    }
    return true;
}
function randomized_data(){
    const user_data = {
        userid : document.getElementById('UserId').innerText,
        departmentId : document.getElementById('department-selection-result').value,
        shiftId : document.getElementById('shift-selection').value
    };
    console.log(user_data);
    if(!verify_path(user_data)){
        return;
    }
    else{
        fetch('/AAI/admin/results/randomized-results/fetch-result.php', {
            method : 'POST',
            headers : {
                'Content-Type' : 'application/json'
            },
            body : JSON.stringify(user_data)
        }).then(response => {
            if(!response.ok){
                console.error("Internal Server Error 404 - Result Fetch");
            }
            return response.text();
        }).then(data => {
            var showDiv = document.getElementById('request-table');
            showDiv.style.display = "block";
            document.getElementById('request-table').innerHTML = data;
        });
    }
}