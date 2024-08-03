
<html>
<head>
    <title>Dynamic Drag and Drop table rows in PHP Mysql- ItSolutionStuff.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
</head>
<body>
    <style>
.box {
  inline-size: 150px; 
  overflow: hidden;
}
/*responsive*/
@media(max-width: 1024px){
	.table thead{
		display: none;
	}

	.table, .table tbody, .table tr, .table td{
		display: block;
		width: 100%;
		table-layout:fixed;
	}
	.table tr{
		margin-bottom:15px;
		word-wrap: break-word;
	}
	.table td{
		text-align: right;
		padding-left: 0%;
		text-align: right;
		position: relative;
		font-size:15px;
		word-wrap:break-word;
		
	}
	
	.table td::before{
		content: attr(data-label);
		position: absolute;
		left:0;
		width: 100%;
		padding-left:10px;
		font-size:15px;
		font-weight: bold;
		text-align: left;
	}

}
</style>
     <div class="container-fluid pt-4 px-4">
        <div class="row bg-light rounded align-items-center justify-content-center mx-0">
            <div style="padding-left: 0px; padding-right: 0px; padding-top:20px;" class="bg-light text-center rounded col-sm-12">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">   All Services Categories</h6>

                    <a class="btn btn-secondary" href="addcat.php">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
                <div  class="table-responsive">
        <table class="table table-bordered">
            <tr>
                            <th>Position</th>
                            <th>Service Category</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
            <tbody class="row_position">
            <?php


            require('db_config.php');


            $sql = "SELECT * FROM services ORDER BY position asc";
            $users = $mysqli->query($sql);
            while($user = $users->fetch_assoc()){


            ?>
                <tr  id="<?php echo $user['id'] ?>">
                    <td data-label="Service Category"><?php echo $user['name'] ?></td>
                    <td data-label="Position"><?php echo $user['position'] ?></td>
                    <td data-label="Edit">
                                    <a class="btn btn-secondary" href="editcat.php?status=<?php echo $row['id']; ?>">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                                <td data-label="Delete">
                                    <a style="color:red;" class="btn btn-primary" href="category.php?del=<?php echo $row['id']; ?>">
                                        <i class="fa fa-cut"></i>
                                    </a>
                                </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
                    </div>
        </div>
    </div>
    </div> <!-- container / end -->
</body>


<script type="text/javascript">
    $( ".row_position" ).sortable({
        delay: 150,
        stop: function() {
            var selectedData = new Array();
            $('.row_position>tr').each(function() {
                selectedData.push($(this).attr("id"));
            });
            updateOrder(selectedData);
        }
    });


    function updateOrder(data) {
        $.ajax({
            url:"ajax.php",
            type:'post',
            data:{position:data},
            success:function(){
                alert('your change successfully saved');
            }
        })
    }
</script>
</html>