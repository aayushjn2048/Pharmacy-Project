<?php
    require_once 'connectDB.php';
    if(isset($_POST['submit']))
    {
        $appointmentId = $_POST["data"];
        //$file = addslashes(file_get_contents($_FILES['file']['tmp_name']));
        /*$filename = file_get_contents($_FILES["file"]["tmp_name"]); 
        $tempname = $_FILES["file"]["tmp_name"];     
        $folder = "image/".$filename; 
        $sql = "UPDATE labreport SET `status`='Successful', report = '$filename' WHERE appointmentId = $appointmentId";*/

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
            echo "<script>window.location = 'labReport.php'</script>";
        }else{
            echo 'Error uploading image';
        }


        /*if ($con->query($sql) === TRUE) {
            move_uploaded_file($tempname, $folder);
            echo $_FILES["file"]["size"];
            //
        } else {
        echo "Error updating record: " . $con->error;
        }*/
    }
    else    
        echo "data didn't recieved";
?>