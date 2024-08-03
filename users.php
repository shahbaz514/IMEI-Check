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

if (isset($_GET['status']))
{
    if ($_SESSION['role'] == 'Admin')
    {
        $sqlStatus = mysqli_query($db, "SELECT * FROM users WHERE id = '".$_GET['status']."'");
        $rowStatus = mysqli_fetch_array($sqlStatus);

        if ($rowStatus['status'] == 'Active')
        {
            if (mysqli_query($db, "UPDATE users SET status = 'Block' WHERE id = '".$_GET['status']."'"))
            {
                header("Location: users.php");
            }
        }
        else
        {

            if (mysqli_query($db, "UPDATE users SET status = 'Active' WHERE id = '".$_GET['status']."'"))
            {
                header("Location: users.php");
            }
        }
    }
    else
    {
        echo "<script>alert('You are not Authorized Person! Please Contact to Admin.')</script>";
        echo "<script>window.open('users.php', '_self')</script>";
    }
}
include "inc/head.php";
echo "<title>IMEICHECK.UK - All Users</title>";
?>

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
                order: [[0, 'desc']],
            });
        });
    </script>
    <div class="container-fluid pt-4 px-4">
        <div class="row bg-light rounded align-items-center justify-content-center mx-0">
            <div style="padding-left: 0px; padding-right: 0px; padding-top:20px;" class="bg-light text-center rounded col-sm-12 ">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Admin Users</h6>

                    <a href="addAdmin.php" class="btn btn-primary">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
                <div class="table-responsive">
                    <table id="example" class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>username</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql = mysqli_query($db, "SELECT * FROM users WHERE role = 'Admin' ORDER BY id DESC");
                        while ($row = mysqli_fetch_array($sql))
                        {
                            ?>
                            <tr>
                                <td data-label="ID"><?php echo $row['id']; ?></td>
                                <td data-label="Name"><?php echo $row['name']; ?></td>
                                <td data-label="Email"><?php echo $row['email']; ?></td>
                                <td data-label="Username"><?php echo $row['username']; ?></td>
                                <td data-label="Phone"><?php echo $row['phone']; ?></td>
                                <td data-label="Role"><?php echo $row['role']; ?></td>
                                <td data-label="Status">
                                    <?php
                                    if ($row['status'] == 'Active')
                                    {
                                        ?>
                                        <a class="btn btn-success" href="users.php?status=<?php echo $row['id']; ?>">
                                            <?php echo $row['status'] ; ?>
                                        </a>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <a class="btn btn-danger" href="users.php?status=<?php echo $row['id']; ?>">
                                            <?php echo $row['status'] ; ?>
                                        </a>
                                        <?php
                                    }
                                    ?>

                                </td>
                                <td data-label="Date"><?php echo $row['date']; ?></td>
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