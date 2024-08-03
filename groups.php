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

include "inc/head.php";
echo "<title>IMEICHECK.UK - All Groups</title>";
?>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#example').DataTable({
               
            });
        });
    </script>

    <div class="container-fluid pt-4 px-4">
        <div class="row bg-light rounded align-items-center justify-content-center mx-0">
            <div class="bg-light text-center rounded col-sm-12 p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">All Groups</h6>

                </div>
                <div  class="table-responsive">
                    <table id="example" class="table text-start align-middle table-bordered table-hover table-striped mb-0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql = mysqli_query($db, "SELECT * FROM groups ORDER BY id ASC");
                        
                        while ($row = mysqli_fetch_array($sql))
                        {
                            ?>
                            <tr style="flex-direction: column-reverse;">
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['date']; ?></td>
                                <td>
                                    <a class="btn btn-secondary" href="editGroup.php?id=<?php echo $row['id']; ?>">
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


<?php
include "inc/footer.php";
?>