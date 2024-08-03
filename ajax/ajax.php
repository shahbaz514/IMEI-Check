<?php 


require('db_config.php');


$position = $_POST['position'];


$i=1;
foreach($position as $k=>$v){
    $sql = "Update services SET position =".$i." WHERE id=".$v;
    $mysqli->query($sql);


	$i++;
}


?>