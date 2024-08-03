<?php
header("Content-Type:application/json");
include('../db/db.php');
if (isset($_GET))
{
    if ($_GET)
    {
        $result = mysqli_query($db,"SELECT * FROM `groups`");
        if(mysqli_num_rows($result)>0){
            while ($row = mysqli_fetch_array($result)){
                $id = $row['id'];
                $name = $row['name'];
                $date = $row['date'];

                response($id, $name, $date);
            }
        }else{
            response(NULL, NULL, 200,"No Record Found");
        }

    }
    else
    {
        echo "$result";
    }
}
else
{
    echo "$result";
}
function response($id, $name, $date){
    $response['id'] = $id;
    $response['name'] = $name;
    $response['date'] = $date;

    $json_response = json_encode($response);
    echo $json_response;
}
?>