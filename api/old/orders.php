<?php
header("Content-Type:application/json");
include('../db/db.php');
if (isset($_GET['api']))
{
    if ($_GET['api'] == 'shahbaz514@786')
    {
        $result = mysqli_query($db,"SELECT * FROM `orders`");
        if(mysqli_num_rows($result)>0){
            while ($row = mysqli_fetch_array($result)){
                $id = mysqli_real_escape_string($db, $row['id']);
                $orderid = mysqli_real_escape_string($db, $row['orderid']);
                $service = mysqli_real_escape_string($db, $row['service']);
                $imei = mysqli_real_escape_string($db, $row['imei']);
                $resulto = mysqli_real_escape_string($db, $row['result']);
                $notes = mysqli_real_escape_string($db, $row['notes']);
                $credits = mysqli_real_escape_string($db, $row['credits']);
                $username = mysqli_real_escape_string($db, $row['username']);
                $status = mysqli_real_escape_string($db, $row['status']);
                $date = mysqli_real_escape_string($db, $row['date']);

                response($id, $orderid, $service, $imei, $resulto, $notes,
                    $credits, $username, $status, $date);
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
function response($id, $orderid, $service, $imei, $resulto, $notes,
                  $credits, $username, $status, $date){

    $response['id'] = $id;
    $response['orderid'] = $orderid;
    $response['service'] = $service;
    $response['imei'] = $imei;
    $response['result'] = $resulto;
    $response['notes'] = $notes;
    $response['credits'] = $credits;
    $response['username'] = $username;
    $response['status'] = $status;
    $response['date'] = $date;

    $json_response = json_encode($response);
    echo $json_response;
}
?>