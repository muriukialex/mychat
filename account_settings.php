<!DOCTYPE html>
<?php
session_start();
include("include/connection.php");
include("include/header.php");

if (!isset($_SESSION['user_email'])) {
    header("location:signin.php");
} else {
?>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/find_people.css">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <title>My Chat - Settings</title>
    </head>

    <body>
        <div class="row">
            <div class="col-sm-2">
            </div>
            <?php
            $user = $_SESSION['user_email'];
            $get_user = "select * from users where user_email='$user'";
            $run_user = mysqli_query($con, $get_user);
            $row = mysqli_fetch_array($run_user);


            $user_name = $row['user_name'];
            $user_pass = $row['user_pass'];
            $user_email = $row['user_email'];
            $user_profile = $row['user_profile'];
            $user_country = $row['user_country'];
            $user_gender = $row['user_gender'];
            ?>

            <div class="col-sm-8">
                <form action="account_settings.php" method="post" enctype="multipart/form-data">
                    <table class="table table-bordered table-hover">
                        <tr align="center">
                            <td colspan="6" class="active">
                                <h2>Change account settings</h2>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Change your user name</td>
                            <td>
                                <input type="text" name="u_name" class="form-control" value="<?php echo $user_name; ?>" required />
                            </td>
                        </tr>

                        <tr>
                            <td>
                            <td>
                                <a href="upload.php" class="btn btn-default" style="text-decoration: none;font-size: 15px;">
                                    <i class="fa fa-user" aria-hidden="true"></i>Change profile
                                </a>
                            </td>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Change your email</td>
                            <td>
                                <input type="email" name="u_email" class="form-control" value="<?php echo $user_email; ?>" required />
                            </td>
                        </tr>

                        <tr>
                            <td style="font-weight: bold;">Country</td>
                            <td>
                                <select name="u_country" class="form-control">
                                    <option><?php echo $user_country ?></option>
                                    <option value="US">US</option>
                                    <option value="UK">UK</option>
                                    <option value="Kenya">Kenya</option>
                                    <option value="Pakistan">Pakistan</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td style="font-weight: bold;">Gender</td>
                            <td>
                                <select name="u_gender" class="form-control">
                                    <option><?php echo $user_gender ?></option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="center">
                            <td colspan="6">
                                <input type="submit" value="Update" name="update" class="btn btn-info" />
                            </td>
                        </tr>
                    </table>
                </form>
                <?php

                if (isset($_POST['update'])) {
                    $user_name = htmlentities($_POST['u_name']);
                    $email = htmlentities($_POST['u_email']);
                    $u_country = htmlentities($_POST['u_country']);
                    $u_gender = htmlentities($_POST['u_gender']);

                    $update = "update users set user_name='$user_name',user_email='$email',user_country='$u_country',user_gender='$u_gender' where user_email='$user'";
                    $run = mysqli_query($con, $update);

                    if ($run) {
                        echo "
                        <script>
                            window.open('account_settings.php','_self');
                        </script>

                        ";
                    }
                }
                ?>

            </div>
            <div class="col-sm-2">

            </div>
        </div>
    </body>

    </html>
<?php } ?>