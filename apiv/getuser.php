<?php

include "connection.php";

$userName = $_POST['username'];
$password = $_POST['password'];

$checkuser = "SELECT from users WHERE username='$userName' and password='$password'";

$result= mysqli_query($db,$checkuser);




if(mysqli_num_rows($result)>0){
    
    while ($row = $result->fetch_assoc()){
    $response['users']= $row;
}
   $response['error'] = "000";
   $response['message'] = "Login Success";
   $response['username'] = "$userName";
}
else{
    $response['error'] = "000";
  $response['message'] = "Login Failed";
    
}

echo json_encode($response);

?>