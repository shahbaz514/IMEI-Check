<?php
ob_start();
session_start();
include "db/db.php";
if (!isset($_SESSION['username']))
{
    header('Location: signin.php');
}
include "inc/head.php";
echo "<title>IMEICHECK.UK - Order History</title>";
?>
<style>
@media screen and (max-width: 767px){
div.dataTables_wrapper div.dataTables_paginate ul.pagination {
    
    display: block;
}}
    /*responsive*/
@media(max-width: 800px){

	.col-sm-6 {
    flex: 0 0 auto;
    width: 100%;
}
}
@media(max-width: 1024px){

	.col-sm-12 {
    flex: 0 0 auto;
    width: 90%;
}
}

@media(max-width: 550px){
	.table thead{
		display: none;
	}

	.table, .table tbody, .table tr, .table td{
		display: block;
		width: 100%;
	}
	.table tr{
		margin-bottom:15px;
	}
	.table td{
		text-align: right;
		padding-left: 10%;
		text-align: right;
		position: relative;
	}
	.table td::before{
		content: attr(data-label);
		position: absolute;
		left:0;
		width: 100%;
		padding-left:15px;
		font-size:15px;
		font-weight: bold;
		text-align: left;
	}
	}
</style>
<div class="col-sm-6">
    <script type="text/javascript">
    $(document).ready(function () {
    $('#example').DataTable();
});
</script>
</div>

    <div style="padding-top: 20px; background: #F3F6F9;" class="container-fluid">
        <div class="row bg-light rounded align-items-center justify-content-center mx-0">
            <div style="padding-left: 0px; padding-right: 0px;" class="bg-light text-center rounded col-sm-12">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">My Results</h6>
                </div>
                <div class="table-responsive">
                    <table id="example" class="table table-striped text-start table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>Status</th>
                            <th>Service</th>
                            <th>IMEI</th>
                            <th>Submitted</th>
                            <th>Credits</th>
                            <th>Result</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if ($_SESSION['role'] == 'Admin')
                        {
                            $sql = mysqli_query($db, "SELECT * FROM orders ORDER BY id DESC");
                        }
                        else
                        {
                            $sql = mysqli_query($db, "SELECT * FROM orders WHERE username = '".$_SESSION['username']."' ORDER BY id DESC");
                        }
                        while ($row = mysqli_fetch_array($sql))
                        {
                            ?>
                            <tr>
                                <td data-label="Status">
                                    <?php
                                    if ($row['status'] == 'Success')
                                    {
                                        echo '<a class="link-success">Success</a>';
                                    }
                                    else
                                    {
                                        echo '<a class="link-danger">Failed</a>';
                                    }
                                    ?>
                                </td>
                                <td data-label="Service"><br>
                                    <?php
                                    $sqlServiceRow = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM services WHERE id = '".$row['service']."'"));
                                    echo $sqlServiceRow['name'];
                                    ?>
                                </td>
                                <td data-label="IMEI"><?php echo $row['imei']; ?></td>
                                <td data-label="Date"><?php echo $row['date']; ?></td>
                                <td data-label="Credits"><?php echo $row['credits']; ?></td>
                                <td data-label="Result"><br>
                                    <?php
                                    if ($row['result'] == null)
                                    {
                                        echo "<span style='color: red;'>Result Not Found</span>";
                                    }
                                    echo $row['result'];
                                    ?>
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



<?php
include "inc/footer.php";
?>