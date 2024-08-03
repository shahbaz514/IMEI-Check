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

if (isset($_GET['id']))
{
    $state = $_GET['state'];
    if ($state == 'Active')
    {
        $s = mysqli_query($db, "UPDATE services SET status = 'Block' WHERE id = '".$_GET['id']."'");
        if ($s)
        {
            header('Location: services.php');
        }
    }
    if ($state == 'Block')
    {
        $s = mysqli_query($db, "UPDATE services SET status = '' WHERE id = '".$_GET['id']."'");
        if ($s)
        {
            header('Location: services.php');
        }
    }

}

if (isset($_GET['del']))
{
    $sqlDel = mysqli_query($db, "DELETE FROM `services` WHERE id = '".$_GET['del']."'");
    if ($sqlDel)
    {
        header('Location: services.php');
    }
}
include "inc/head.php";
echo "<title>IMEICHECK.UK - All Services</title>";
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
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
      <script type="text/javascript">
        $(document).ready(function () {
            $('#example').DataTable({
              
                var table = $('#example').DataTable();
 
table.ajax.reload( function ( json ) {
    $('#myInput').val( json.lastInput );
} );
            });
        });
      
    </script>
    <div class="container-fluid pt-4 px-4">
        <div class="row bg-light rounded align-items-center justify-content-center mx-0">
            <div style="padding-left: 0px; padding-right: 0px; padding-top:20px;" class="bg-light text-center rounded col-sm-12">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">All Services</h6>

                    <a class="btn btn-secondary" href="addService.php">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
                
                <div  class="table-responsive">
                    <table id="example" class="table text-start align-middle table-bordered table-hover table-striped mb-0 tbreak">
                        <thead>
                          
                        <tr>
                            <th>ID</th>
                            <th>Service</th>
                            <th>Price</th>
                            <th>API Link</th>
                            <th>Cost Default Group</th>
                            <th>Cost G2</th>
                            <th>Cost G3</th>
                            <th>Category</th>
                            <th>Action</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody class="row_setting">
                            
                        <?php
                        require('db_config.php');
                        $sql = mysqli_query($db, "SELECT * FROM services order by position asc");
                        while ($row = mysqli_fetch_array($sql))
                        {
                            ?>
                            <tr id="<?php echo $row['id'] ?>">
                                <td data-label="ID"><?php echo $row['id']; ?></td>
                                <td data-label="Service"><?php echo $row['name']; ?></td>
                                <td data-label="Price"><?php echo $row['price']; ?></td>
                                <td data-label="API Link"><?php echo substr($row['link'], 0, 25); ?></td>
                                <td data-label="Cost G1"><?php echo $row['cost1']; ?></td>
                                <td data-label="Cost G2"><?php echo $row['cost2']; ?></td>
                                <td data-label="Cost G3"><?php echo $row['cost3']; ?></td>
                                <td data-label="Category"><?php 
                                $d = mysqli_query($db, "SELECT * FROM categories WHERE id =  '".$row['category']."' ");
                                $r = mysqli_fetch_array($d);
                                echo $r['name'];
                                ?>
                                </td>
                                <td data-label="Action">

                                        <?php
                                        if ($row['status'] == '')
                                        {
                                            echo '<a class="btn btn-success" href="services.php?id='.$row['id'].'&&state=Active"><i></i>Active</a>';
                                        }
                                        else
                                        {
                                            echo '<a class="btn btn-danger" href="services.php?id='.$row['id'].'&&state=Block"><i></i>Block</a>';
                                        }
                                        ?>
                                    </a>
                                </td>
                                <td data-label="Edit">
                                    <a class="btn btn-secondary" href="editService.php?status=<?php echo $row['id']; ?>">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                                <td data-label="Delete">
                                    <a style="color:red;" class="btn btn-primary" href="services.php?del=<?php echo $row['id']; ?>">
                                        <i class="fa fa-cut"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->
<script type="text/javascript">
    $( ".row_setting" ).sortable({
        delay: 150,
        stop: function() {
            var selectedData = new Array();
            $('.row_setting>tr').each(function() {
                selectedData.push($(this).attr("id"));
            });
            updateOrder(selectedData);
        }
    });


    function updateOrder(data) {
        $.ajax({
            url:"ajaxs.php",
            type:'post',
            data:{position:data},
            success:function(){
                alert('your change successfully saved');
                window.setTimeout( function() {
  window.location.reload();
}, 3);
            }
        })
    }
    
    
</script>

<?php
include "inc/footer.php";
?>