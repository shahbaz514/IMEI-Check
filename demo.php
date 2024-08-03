<!doctype html>
<?php
ob_start();
session_start();
include "db/db.php";
if (!isset($_SESSION['username']))
{
    header('Location: signin.php');
}
if ($_SESSION['role'] != 'Admin')
{
    header('Location: index.php');
}


if (isset($_GET['del']))
{
    $sqlDel = mysqli_query($db, "DELETE FROM `categories` WHERE id = '".$_GET['del']."'");
    if ($sqlDel)
    {
        header('Location: category.php');
    }
}
include "inc/head.php";
echo "<title>IMEICHECK.UK - All Services Categories</title>";
?>
<html lang="en">
    
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Sortable - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <style>
  #sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
  #sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 45px; }
  #sortable li span { position: absolute; margin-left: -1.3em; }
  
   .box
   {
    width:1270px;
    padding:20px;
    background-color:#fff;
    border:1px solid #ccc;
    border-radius:5px;
    margin-top:25px;
   }
   #page_list li
   {
    padding:16px;
    background-color:#f9f9f9;
    border:1px dotted #ccc;
    cursor:move;
    margin-top:12px;
   }
   #page_list li.ui-state-highlight
   {
    padding:24px;
    background-color:#ffffcc;
    border:1px dotted #ccc;
    cursor:move;
    margin-top:12px;
   }
  
  </style>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script>
  $(document).ready(function(){
 $( "#page_list" ).sortable({
  placeholder : "ui-state-highlight",
  update  : function(event, ui)
  {
   var page_id_array = new Array();
   $('#page_list li').each(function(){
    page_id_array.push($(this).attr("id"));
   });
   $.ajax({
    url:"sort.php",
    method:"POST",
    data:{page_id_array:page_id_array},
    success:function(data)
    {
     alert(data);
    }
   });
  }
 });

});
  </script>
</head>
<body>
 
<ul class="list-unstyled" id="page_list">
    <?php
                        $sql = mysqli_query($db, "SELECT * FROM categories WHERE position ");
                        while ($row = mysqli_fetch_array($sql))
                        {
                            ?>
                            
  <li id="page_list" class="ui-state-default" id="page_id_array"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><?php echo $row['position']; ?> - <?php echo $row['name']; ?></li>
 <?php
                        }
                        ?>
</ul>
 
 
</body>
</html>