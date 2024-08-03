<?php
ob_start();
session_start();
include "db/db.php";
if (!isset($_SESSION['username']))
{
    header('Location: signin.php');
}
include "inc/head.php";
echo "<title>IMEICHECK.UK - All Top Ups</title>";
?>


    <style>
        h3 .fa-search{
            padding: 60px;
            border-radius: 50%;
            border: 2px solid #0dcaf0;
            color: #0dcaf0;
        }
        h3 .fa-copy{
            padding: 60px;
            border-radius: 50%;
            border: 2px solid #0dcaf0;
            color: #0dcaf0;
        }
        .fa-eye{
            border-radius: 50%;
            color: #FFFFFF;
            text-align:center;
        }
        .btn-info{
            background-color: #0dcaf0;
            color: white;
            padding: 10px;
            width: 120px;
        }
        .btn-info:hover{
            color: white;
            padding: 10px;
            width: 120px;
        }
        .btn-success{
            color: #0c4128;
            color: #FFFFFF;
            padding: 10px;
            width: 120px;
        }
        .btn-info{
            background-color: #0dcaf0;
            color: white;
            padding: 10px;
            width: 120px;
        }
        .btn-info:hover{
            color: white;
            padding: 10px;
            width: 120px;
        }
        .btn-success{
            color: #0c4128;
            color: #FFFFFF;
            padding: 10px;
            width: 120px;
        }
        .btn-warning{
            background-color: #efc23c;
            color: white;
            padding: 10px;
            width: 50px;
            height:40px;
        }
        .btn-warning:hover{
            background-color: #efc23c;
            color: white;
            padding: 10px;
            width: 50px;
            height:40px;
        }
     
   .btn{
        line-height: 0.5!important;
    }


/*responsive*/
@media(max-width: 786px){
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
		padding-left: 0%;
		text-align: right;
		position: relative;
		font-size:15px;
	}
	.table td::before{
		content: attr(data-label);
		position: absolute;
		left:0;
		width: 20%;
		padding-left:10px;
		font-size:15px;
		font-weight: bold;
		text-align: left;
	}
	.dataTables_paginate .paging_simple_numbers{
	    width:50px;
	}
}


    </style>

<script type="text/javascript">
    $(document).ready(function () {
    $('#example').DataTable({
        order: [[0, 'desc']],
    });
});
</script>
    <div class="container-fluid pt-4 px-4">
        <div class="row bg-light rounded align-items-center justify-content-center mx-0">
            <div style="padding-left: 0px; padding-right: 0px;" class="bg-light text-center rounded col-sm-12 p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">All Top Up</h6>
                </div>
                <div class="table-responsive">
                    <table id="example" class="table text-center align-middle table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Order</th>
                            <th>Payment Method</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if ($_SESSION['role'] == 'Admin')
                        {
                            $sql = mysqli_query($db, "SELECT * FROM credits ORDER BY id DESC");
                        }
                        else
                        {
                            $sql = mysqli_query($db, "SELECT * FROM credits WHERE username = '".$_SESSION['username']."' ORDER BY id DESC");
                        }
                        while ($row = mysqli_fetch_array($sql))
                        {
                            ?>
                            <tr>
                                <td data-label="Invoice">INV-<?php echo $row['invoice_no']; ?></td>
                                <td data-label="Customer"><?php echo $row['username']; ?></td>
                                <td data-label="Amount">$<?php echo $row['total_amount']; ?></td>
                                <td data-label="Status">
                                    <?php
                                    if ($row['status'] == 'Paid')
                                    {
                                        echo '<a class="link-success">Paid</a>';
                                    }
                                    else if ($row['status'] == 'Rejected')
                                    {
                                        echo '<a class="link-danger">Rejected</a>';
                                    }
                                    else if ($row['status'] == 'Cancel')
                                    {
                                        echo '<a class="link-warning">Failed</a>';
                                    }
                                    else
                                    {
                                        echo '<a class="link-info">UnPaid</a>';
                                    }
                                    ?>
                                </td>
                                <td data-label="Order"><?php echo $row['item']; ?></td>
                                <td data-label="Method"><?php echo $row['payment_method']; ?></td>
                                <td data-label="Date"><?php echo $row['date']; ?></td>
                                <td data-label="Action">
                                    <a class="btn btn-warning" href="invoiceDetails.php?invoice=<?php echo $row['invoice_no']; ?>">
                                        <i class="fa fa-eye"></i>
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



<?php
include "inc/footer.php";
?>