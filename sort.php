

<?php
ob_start();
session_start();
include "db/db.php";
if (!isset($_SESSION['username']))
{
    header('Location: signin.php');
}
//include "inc/head.php";
print_r($i);
print_r($_POST["page_id_array"]);
var_dump($_POST["page_id_array"]);

//echo "<title>IMEICHECK.UK - Edit Services Category</title>";


for($i=0; $i<count($_POST["page_id_array"]); $i++)
{
    

// $query = "
 //UPDATE categories 
 //SET position = '".$i."' 
//WHERE id = '".$_POST["page_id_array"][$i]."'";

 $update = mysqli_query($db, "UPDATE services SET  position = '$i' WHERE id = '".$_POST ["page_id_array"]."' ");
 //mysqli_query($db, $query);
 
}
echo 'Page Order has been updated';
echo $_POST["page_id_array"];

/*$menu = $_POST['menu'];
for ($i = 0; $i < count($menu); $i++)
{
$update = mysqli_query($db, "UPDATE categories SET  position = '$i' WHERE id = '".$menu[$i]."' ");*/
//$sql = mysqli_query($db, "SELECT * FROM categories ");
//$row = mysqli_fetch_array($sql);
//}
/*if(isset($_GET["sort_order"])) {
	$id_ary = explode(",",$_GET["sort_order"]);
	for($i=0;$i<count($id_ary);$i++) {		
		$sql = "UPDATE php_questions SET display_order='" . $i . "' WHERE id=". $id_ary[$i];
		mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
	}
}*/

?>




