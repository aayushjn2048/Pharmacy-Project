<?php
    require_once 'connectDB.php';
    if(isset($_GET['appointmentId']))
    {
        $appointmentId = $_GET['appointmentId'];
        $date = $_GET['date'];
        $time = $_GET['time'];
        $idpat = $_GET['idPatient'];
        $datetime = $date.' '.$time.':00';
        $query="insert into labreport (appointmentId,patientId,dateTime) values('$appointmentId','$idpat','$datetime')";
        $x=mysqli_query($con,$query);
        if(!$x)
            echo $con->error;
        else
        {
            $y=mysqli_query($con,"select firstName,lastName,email from patient where patient.idpatient = $idpat");
            if ($y->num_rows > 0) 
            {
                while($row = $y->fetch_assoc())
                {
                    $to = $row['email'];
                    $subject = "Doctor's Appointment";
                    $txt = $row['firstName']." ".$row['lastName'].", your appointment has been set for ".$date." on ".$time.". Have a good day!!!";
                    $headers = "From: naturska123@gmail.com" . "\r\n" ."CC: labassignment2048@gmail.com";
                    if(mail($to,$subject,$txt,$headers))
                        echo "Successful!!!";
                    else
                        echo "Didn't work!!!";
                }
            }
            echo '<script>window.location = "labReport.php"</script>';
        }
    }
    else    
        echo "Not working!!!";
?>