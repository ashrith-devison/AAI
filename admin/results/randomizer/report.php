<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        function updateShiftAssigned($empid,$shift){
            $conn = mysqli_connect("localhost","root","","project-ba");
            $query = "INSERT INTO shift_assigned (Employee_ID,ShiftID) VALUES ($empid,'$shift')";
            $conn->query($query);
            $query = "INSERT INTO ba_test (Employee_ID) VALUES ($empid)";
            $conn->query($query);
            $conn->close();
        }
        
        function updateenvdata($deptcode){
            $conn = mysqli_connect("localhost","root","","project-ba");
            $query = "UPDATE envdata SET randomized_time = NOW() WHERE dept_code = '$deptcode';";
            $conn->query($query);
            $conn->close();
        }

        $request = file_get_contents("php://input");
        $request = json_decode($request);

        $empid = $request->empId;
        $empname = $request->empName;
        $shift = $request->shiftId;
        $deptcode = $request->deptCode;
        $data = array_map(null,$empid,$empname);
        echo "<h4>Shortlisted People from Randomizer</h4>";
        echo "<link rel='stylesheet' href='/admin/results/randomizer/table.css'>";
        echo "<table class='table' >";                                                                                                                                                                                                                                                                                  
        echo "<thead>";
        echo "<tr>";
        echo "<th>Employee Id</th>";
        echo "<th>Employee Name</th>";
        echo "</tr>";
        echo "</thead><tbody>";

        $conn = mysqli_connect("localhost","root","","project-ba");
        if(!$conn){
            die("Connection Error");
        }
        else{
            $sql = "DELETE FROM shift_assigned WHERE randomized_time < CURDATE();";
            $conn->query($sql);
            
        }
        foreach($data as $emp){
            list($empid, $empname) = $emp;
            echo "<tr>";
            echo "<td>".$empid."</td>";
            echo "<td>".$empname."</td>";
            updateShiftAssigned(intval($empid),$shift);
            echo "</tr>";
        }
        echo "</tbody>";
        updateenvdata($deptcode);
    }

    else{
        echo 
        "<script src='/node_modules/sweetalert2/dist/sweetalert2.all.min.js'></script>
        <script>
            window.onload = function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'Invalid Request',
                    icon: 'error',
                    confirmButtonText: 'OK',
                });
            }
        </script>";
    }

?>