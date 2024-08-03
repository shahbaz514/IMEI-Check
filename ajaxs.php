<?php 


require('db_config.php');


$position = $_POST['position'];


$s=1;
foreach($position as $k=>$v){
    $sql = "Update services SET position =".$s." WHERE id=".$v;
    $mysqli->query($sql);


	$s++;
}


?>