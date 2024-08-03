<?php
header("Content-Type:application/json");
include('../db/db.php');
if (isset($_GET['api']))
{
    if ($_GET['api'] == 'shahbaz514@786')
    {
        $result = mysqli_query($db,"SELECT * FROM `credits`");
        if(mysqli_num_rows($result)>0){
            while ($row = mysqli_fetch_array($result)){
                $id = $row['id'];
                $username = $row['username'];
                $invoice_no = $row['invoice_no'];
                $item = $row['item'];
                $qty = $row['qty'];
                $total_amount = $row['total_amount'];
                $inv_date = $row['inv_date'];
                $due_date = $row['due_date'];
                $suply_date = $row['suply_date'];
                $payment_method = $row['payment_method'];
                $status = $row['status'];
                $prof = $row['prof'];
                $payment_id = $row['payment_id'];
                $payer_id = $row['payer_id'];
                $payer_email = $row['payer_email'];
                $date = $row['date'];

                response($id, $username, $invoice_no, $item, $qty, $total_amount,
                        $inv_date, $due_date, $suply_date, $payment_method, $status,
                        $prof, $payment_id, $payer_id, $payer_email, $date);
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
function response($id, $username, $invoice_no, $item, $qty, $total_amount,
                  $inv_date, $due_date, $suply_date, $payment_method, $status,
                  $prof,  $payment_id, $payer_id, $payer_email, $date){
    $response['id'] = $id;
    $response['username'] = $username;
    $response['invoice_no'] = $invoice_no;
    $response['item'] = $item;
    $response['qty'] = $qty;
    $response['total_amount'] = $total_amount;
    $response['inv_date'] = $inv_date;
    $response['due_date'] = $due_date;
    $response['suply_date'] = $suply_date;
    $response['payment_method'] = $payment_method;
    $response['status'] = $status;
    $response['prof'] = $prof;
    $response['payment_id'] = $payment_id;
    $response['payer_id'] = $payer_id;
    $response['payer_email'] = $payer_email;
    $response['date'] = $date;

    $json_response = json_encode($response);
    echo $json_response;
}
?>