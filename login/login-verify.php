<?php
    $conn = mysqli_connect("localhost","root","","project-ba");
    if(!$conn){
        die("Connection Error");
    }
    else{
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $request = file_get_contents("php://input");
            $request = json_decode($request,true);

            $loginid = $request['userid'];
            $passkey = $request['passkey'];

            $query = "SELECT * FROM login_credentials WHERE username = '$loginid'";
            $loginData = $conn->query($query);
            $loginData = $loginData->fetch_assoc();
            if($loginData){
                if($loginData['passkey'] === $passkey){
                    if($loginData['role'] === 'admin'){
                        echo json_encode(['userid' => $loginData['username'], 'url' => '/AAI/admin/home-page/home.php']);
                    }
                }
                else{
                    echo json_encode(['userid' => 'XYZ', 'content' => '<p>Invalid User</p>']);
                }
            }

        }
    }
?>