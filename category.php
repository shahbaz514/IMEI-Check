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
                    <h6 class="mb-0">   All Services Categories</h6>

                    <a class="btn btn-secondary" href="addcat.php">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
                <div  class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover table-striped mb-0 tbreak">
                        <thead>
                        <tr>
                           
                            <th>Service Category</th>
                            <th>Edit</th>
                           
                        </tr>
                        </thead>
                        <tbody class="row_position">
                        <?php
                        $sql = mysqli_query($db, "SELECT * FROM categories order by position asc");
                        while ($user = mysqli_fetch_array($sql))
                        {
                            ?>
                            <tr  id="<?php echo $user['id'] ?>">
                                
                                <td data-label="Service Category"><?php echo $user['name']; ?></td>
                                <td data-label="Edit">
                                    <a class="btn btn-secondary" href="editcat.php?status=<?php echo $user['id']; ?>">
                                        <i class="fa fa-edit"></i>
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