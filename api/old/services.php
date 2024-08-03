<?php
header("Content-Type:application/json");
include('../db/db.php');

$cat = mysqli_query($db, "SELECT * FROM categories ORDER BY position ASC");
while($rowCat = mysqli_fetch_array($cat))


if (isset($_GET['api']))
{
    if ($_GET['api'] == 'shahbaz514@786')
    {
       $response = mysqli_query($db, "SELECT * FROM services WHERE category = '".$rowCat['id']."' ORDER BY position ASC");
                                        while ($rowServices = mysqli_fetch_array($sqlServices)) {
                                            $sqlU = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM users WHERE username = '".$_SESSION['username']."'"));
                                            $g = $sqlU['group'];
                                        
                $id = $row['id'];
                $name = $row['name'];
                $link = $row['link'];
                $price = $row['price'];
                $cost1 = $row['cost1'];
                $cost2 = $row['cost2'];
                $cost3 = $row['cost3'];
                $status = $row['status'];
                $date = $row['date'];

                $response($id, $name, $link, $price, $cost1, $cost2,
                    $cost3, $status, $date);
            }
        }else{
            response(NULL, NULL, 200,"No Record Found");
        }

    }
    else
    {
        echo "Enter Correct Api!";
    }



function response($id, $name, $link, $price, $cost1, $cost2,
                  $cost3, $status, $date){
    $response['id'] = $id;
    $response['name'] = $name;
    $response['link'] = $link;
    $response['price'] = $price;
    $response['cost1'] = $cost1;
    $response['cost2'] = $cost2;
    $response['cost3'] = $cost3;
    $response['status'] = $status;
    $response['date'] = $date;

    $json_response = json_encode($response);
    echo $json_response;
}
?>