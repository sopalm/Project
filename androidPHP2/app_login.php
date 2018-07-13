<?php
    
	include('../connection.php');
    $username = $_POST['username'];
    $password = $_POST['password'];
    
	$result = mysqli_query($con, "SELECT * from user  
                                            join check_service_tag on user.cst_id = check_service_tag.cst_id 
                                            where user_name='$username' and user_pass = '$password'")
        or die("Failed db".mysqli_error());
    $row = mysqli_fetch_array($result);

    $response = array();
    if($row['user_name']==$username && $row['user_pass']==$password && $username!='' &&$password!='' )  {
        $arr = array(
                'status' => "true",
                'user' => $row['user_name'],
                'tag' => $row['tag']
            );
            array_push($response, $arr);
        echo json_encode($response, JSON_UNESCAPED_UNICODE); 
    }
?>