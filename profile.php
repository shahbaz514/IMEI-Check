<?php
ob_start();
session_start();
include "db/db.php";
if (!isset($_SESSION['username']))
{
    header('Location: signin.php');
}
include "inc/head.php";
echo "<title>IMEICHECK.UK - Profile</title>";
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
            padding: 20px;
            border-radius: 50%;
            color: #FFFFFF;
        }
        .btn-info{
            background-color: #0dcaf0;
            color: white;
            padding: 10px;
            width: 120px;
        }
        .btn-warning{
            background-color: #efc23c;
            color: white;
            padding: 10px;
            width: 120px;
        }
        .btn-warning:hover{
            background-color: #efc23c;
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
    </style>
    <div class="container-fluid pt-4 px-4">
        <div style="height: 480px;" class="row bg-light rounded align-items-center justify-content-center mx-0">
            <div class="col-sm-3"></div>
            <div class="bg-light text-center rounded col-sm-6">
                <div class="col-sm-12">
                    <div class="bg-light rounded">
                        <div class="testimonial-item text-center">
                            <?php
                            if ($userCredentials['img'] == "")
                            {
                                echo '<img class="rounded-circle" src="img/user.jpg" style="width: 200 px; height: 200px;">';
                            }
                            else
                            {
                                echo '<img class="rounded-circle" src="img/'.$userCredentials['img'].'" style="width: 100px; height: 100px;border: 2px solid #0dcaf0; padding: 2px; margin: 5px;">';
                            }
                            ?>
                            <h5  class="text-uppercase"><?php echo $userCredentials['name']; ?></h5>
                            <table class="table text-start align-middle table-bordered table-hover mb-0">
                                <tr>
                                    <th>Role:</th>
                                    <td><?php echo $userCredentials['role']; ?></td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td><?php echo $userCredentials['email']; ?></td>
                                </tr>
                                <tr>
                                    <th>Phone:</th>
                                    <td><?php echo $userCredentials['phone']; ?></td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td><?php echo $userCredentials['status']; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <center>
                                            <a href="settings.php" class="btn btn-primary">
                                                <i class="fa fa-edit"></i>EDIT
                                            </a>
                                            
                                        </center>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </div>
    <!-- Recent Sales End -->



<?php
include "inc/footer.php";
?>