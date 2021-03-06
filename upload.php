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

        <title>My Chat - Change Profile Pic</title>
    </head>

    <body>
        <?php

        $user = $_SESSION['user_email'];
        $get_user = "select * from users where user_email='$user'";
        $run_user = mysqli_query($con, $get_user);
        $row = mysqli_fetch_array($run_user);


        $user_name = $row['user_name'];
        $user_profile = $row['user_profile'];

        echo "
            <div class='card'>
            <img src='$user_profile' width='100' height='100' style={border: radius 5px;}>
            <h1>$user_name</h1>

            <form method='post' enctype='multipart/form-data'>
            <label id='update_profile'>
                <i class='fa fa-circle-o' aria-hidden='true'>Select Profile</i>
            
            <input type='file' name='u_image' size='60'>
            </label>
                <button id='button_profile' name='update'>&nbsp;&nbsp;&nbsp;<i class='fa fa-heart' aria-hidden='true'>Update Profile</i></button>
            </form>
            </div><br><br>
        ";

        if (isset($_POST['update'])) {
            $u_image = $_FILES['u_image']['name'];
            $image_tmp = $_FILES['u_image']['tmp_name'];

            $random_number = rand(1, 100);

            if ($u_image == '') {
                echo "  <script>
                        alert('Please select a profile picture');
                        </script>";
                echo "<script>window.open('upload.php','_self')</script>";
                exit();
            } else {
                move_uploaded_file($image_tmp, "images/$u_image.$random_number");
                $update = "UPDATE users SET user_profile='images/$u_image.$random_number' WHERE user_email='$user'";
                $run = mysqli_query($con, $update);

                if ($run) {
                    echo "  <script>
                        alert('Profile updated succesfully!');
                            </script>";
                    echo "<script>window.open('upload.php','_self')</script>";
                }
            }
        }
        ?>
    </body>

    </html>

<?php
}
?>