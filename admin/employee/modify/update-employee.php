<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $conn = mysqli_connect("localhost","root","","project-ba");
        if(!$conn){
            die("Connection Error");
        }
        $request = file_get_contents("php://input");
        $request = json_decode($request);
        $empid = $request->empid;
        $empname = $request->empname;
        $dept = $request->deptid;
        $role = $request->role;
        $query = "UPDATE employees SET Emp_Name = '$empname', Designation = '$role',
        Department_Id = '$dept' WHERE Employee_ID = $empid";
        
        if($conn->query($query)){
            echo "UPDATED SUCCESSFULLY..";
        }
        else{
            echo "Failed";
        }
    }
?>