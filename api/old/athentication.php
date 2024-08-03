<?php
header("Content-Type:application/json");
include('../db/db.php');
if (isset($_GET['api']))
{
    if ($_GET['api'] == 'shahbaz514@786')
    {
        $result = mysqli_query($db,"SELECT * FROM `athentication`");
        if(mysqli_num_rows($result)>0){
            while ($row = mysqli_fetch_array($result)){
                $id = $row['id'];
                $stripe_secret_key = $row['stripe_secret_key'];
                $stripe_publishable_key = $row['stripe_publishable_key'];
                $paypal_CLIENT_ID = $row['paypal_CLIENT_ID'];
                $paypal_CLIENT_SECRET = $row['paypal_CLIENT_SECRET'];
                $usdt_address = $row['usdt_address'];
                $date = $row['date'];

                response($id, $stripe_secret_key, $stripe_publishable_key, $paypal_CLIENT_ID, $paypal_CLIENT_SECRET,
                    $usdt_address, $date);
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
function response($id, $stripe_secret_key, $stripe_publishable_key, $paypal_CLIENT_ID, $paypal_CLIENT_SECRET,
                  $usdt_address, $date){
    $response['id'] = $id ;
    $response['stripe_secret_key'] = $stripe_secret_key ;
    $response['stripe_publishable_key'] = $stripe_publishable_key ;
    $response['paypal_CLIENT_ID'] = $paypal_CLIENT_ID ;
    $response['paypal_CLIENT_SECRET'] = $paypal_CLIENT_SECRET ;
    $response['usdt_address'] = $usdt_address ;
    $response['date'] = $date ;

    $json_response = json_encode($response);
    echo $json_response;
}
?>