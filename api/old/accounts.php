<?php
header("Content-Type:application/json");
include('../db/db.php');
if (isset($_GET['api']))
{
    if ($_GET['api'] == 'shahbaz514@786')
    {
        $result = mysqli_query($db,"SELECT * FROM `accounts`");
        if(mysqli_num_rows($result)>0){
            while ($row = mysqli_fetch_array($result)){
                $id = $row['id'];
                $bank = $row['bank'];
                $title = $row['title'];
                $ac_num = $row['ac_num'];
                $date = $row['date'];

                response($id, $bank, $title, $ac_num, $date);
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
function response($id, $bank, $title, $ac_num, $date){

    $response['id'] = $id;
    $response['bank'] = $bank;
    $response['title'] = $title;
    $response['ac_num'] = $ac_num;
    $response['date'] = $date;

    $json_response = json_encode($response);
    echo $json_response;
}
?>