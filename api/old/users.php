<?php
header("Content-Type:application/json");
include('../db/db.php');
if (isset($_GET['api']))
{
    if ($_GET['api'] == 'shahbaz514@786')
    {
        $result = mysqli_query($db,"SELECT * FROM `users`");
        if(mysqli_num_rows($result)>0){
            while ($row = mysqli_fetch_array($result)){
                $id = $row['id'];
                $name = $row['name'];
                $email = $row['email'];
                $username = $row['username'];
                $password = $row['password'];
                $img = $row['img'];
                $phone = $row['phone'];
                $role = $row['role'];
                $status = $row['status'];
                $wallet = $row['wallet'];
                $fraud = $row['fraud'];
                $group = $row['group'];
                $date = $row['date'];

                response($id, $name, $email, $username, $password, $img,
                    $phone, $role, $status, $wallet, $fraud, $group, $date);
            }
        }else{
            response(NULL, NULL, 200,"No Record Found");
        }

    }
    else
    {
        echo "Enter Correct Api!";
    }
}
else
{
    echo "Enter Api Key!";
}
function response($id, $name, $email, $username, $password, $img,
                  $phone, $role, $status, $wallet, $fraud, $group, $date){
    $response['id'] = $id;
    $response['name'] = $name;
    $response['email'] = $email;
    $response['username'] = $username;
    $response['password'] = $password;
    $response['img'] = $img;
    $response['phone'] = $phone;
    $response['role'] = $role;
    $response['status'] = $status;
    $response['wallet'] = $wallet;
    $response['fraud'] = $fraud;
    $response['group'] = $group;
    $response['date'] = $date;
    $alldata = array();
foreach($response as $single){
     $alldata[] = array($single->id, $single->name);
}
$Response1 = array('data' => $alldata ); 

    $json_response = json_encode($Response1);
    echo $json_response;
}
?>