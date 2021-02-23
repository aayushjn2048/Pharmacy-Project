<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<?php
    require_once 'connectDB.php';
    if(isset($_GET['newdate']))
    {
        $newdate = $_GET['newdate'];
        $papno = $_GET['papno'];
        $sql = "UPDATE subscriptions SET `status`='successful', lastUpdate = '$newdate' WHERE paperNo = $papno";
        if ($con->query($sql) === TRUE) {
            echo '<script>window.location = "subscription.php";</script>';
        } else {
        echo "Error updating record: " . $con->error;
        }
    }
    else if(isset($_POST['submit']))
    {
        $appointmentId = $_POST["data"];
        $newdate = $_POST['date'];

        $image = $_FILES['file']['tmp_name'];
        $img = file_get_contents($image);
        $stat = "Successful";
        $sql = "UPDATE labreport SET `status` = ?,report = ?
                 WHERE appointmentId = $appointmentId;";

        $stmt = mysqli_prepare($con,$sql);
        echo $con->error;
        //$stmt->bind_param($stat,$img);
        mysqli_stmt_bind_param($stmt, "ss",$stat,$img);
        mysqli_stmt_execute($stmt);

        $check = mysqli_stmt_affected_rows($stmt);
        if($check==1){
            $sql2 = "UPDATE subscriptions SET `status`='successful', lastUpdate = '$newdate' WHERE paperNo = $appointmentId";
            if ($con->query($sql2) === TRUE) {
                echo '<script>window.location = "subscription.php";</script>';
            } else {
            echo "Error updating record: " . $con->error;
            }
        }else{
            echo 'Error uploading image';
        }

    }
    else
        echo "Not working!!";
?>
</body>
</html>