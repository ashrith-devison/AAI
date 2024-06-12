<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $conn = mysqli_connect("localhost","root","","project-ba");
        if(!$conn){
            die("Connection Error");
        }
        $request = file_get_contents("php://input");
        $request = json_decode($request);
        $empid = intval($request->empid);
    
        $query = "SELECT * FROM employees e, department d WHERE e.Employee_ID = $empid
        AND e.Department_Id = d.Department_Id";
        $result = $conn->query($query);
        $data = $result->fetch_assoc();
        echo json_encode([
            'empid' => $data["Employee_ID"],
            'empname' => $data["Emp_Name"],
            'role' => $data["Designation"],
            'dept' => $data["Department_name"],
            'deptid' => $data["Department_Id"]
        ]);
        $conn->close();
    }
?>