

<?php
ob_start();
session_start();
include "db/db.php";
if (!isset($_SESSION['username']))
{
    header('Location: signin.php');
}
//include "inc/head.php";


//echo "<title>IMEICHECK.UK - Edit Services Category</title>";


for($s=0; $s<count($_POST["page_id_array"]); $s++)
{
    

// $query = "
 //UPDATE categories 
 //SET position = '".$i."' 
//WHERE id = '".$_POST["page_id_array"][$i]."'";

 $update = mysqli_query($db, "UPDATE services SET  position = '$s' WHERE id = '".$_POST ["page_id_array"]."' ");
 //mysqli_query($db, $query);
 
}
echo 'Page Order has been updated';
echo $_POST["page_id_array"];
?>




