<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        *,
        *:before,
        *:after {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        textarea:focus, 
        textarea.form-control:focus, 
        input.form-control:focus, 
        input[type=text]:focus, 
        input[type=password]:focus, 
        input[type=email]:focus, 
        input[type=number]:focus, 
        [type=text].form-control:focus, 
        [type=password].form-control:focus, 
        [type=email].form-control:focus, 
        [type=tel].form-control:focus, 
        [contenteditable].form-control:focus {
            box-shadow: inset 0 -1px 0 #ddd;
        }
        .fonted1 {
            font-size: 1em;
            font-family: Arial, Helvetica, sans-serif;
            color: rgb(253, 252, 250);
            text-align: center;
        }
        .backgrounded1 {
            background-color: rgb(9, 107, 99);
            border-bottom-left-radius: 2em;
            border-bottom-right-radius: 2em;
        }
        .card {
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
            width: 20em;
            margin-top: 1em;
            margin-bottom: 1em;
        }
        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }
        .card2 {
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
            width: 40em;
            margin-top: 1em;
            margin-bottom: 1em;
        }
        .card2:hover {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }
        .topnav {
            overflow: hidden;
            background-color: white;
            width: max-content;
            border-radius: 5px;
        }
        .topnav a {
            float: left;
            color: black;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }
        .topnav a:hover {
            background-color: #ddd;
            text-decoration: none;
            color: black;
        }
        .topnav a.active{
            background-color: rgb(9, 107, 99);
            text-decoration: none;
            color: rgb(253, 252, 250);
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type = "text/javascript">
        function removeNone(idphy,idpat,papno)
        {
            var x = document.getElementsByClassName('jsHandle');
            for(var i=0;i<x.length;i++)
            {
                if(!x[i].classList.contains('d-none'))
                    x[i].classList.add("d-none");
            }
            var code = ""+idphy+"-"+idpat+"-"+papno;
            for(var i=0;i<x.length;i++)
            {
                //console.log("Value: ",x[i].id);
                if(x[i].id == code)
                {
                    x[i].classList.remove("d-none");
                    break;
                }
            }
        }
        function completion()
        {
            var x = document.getElementsByClassName('jsHandle');
            for(var i=0;i<x.length;i++)
            {
                if(!x[i].classList.contains('d-none'))
                {
                    var code = x[i].id;
                    var data = code.split('_');
                    //alert(data);
                    location.href = "subComplete.php?newdate="+data[0]+"&papno="+data[1];
                    break;
                }
            }
        }
        function goback()
            {
                window.history.back();
            }
    </script>
</head>
<body>
    <div class="container-fluid px-3">
        <div class="fonted1 backgrounded1 p-2 pt-3">
            <h3>Subscribed Prescription/Reports</h3>
        </div>
        <div class="card ml-1 mt-4" style = "border-radius: 5px; width: max-content;">
            <div>
                <button class = "btn" style = "background-color: white; line-height: 1em; padding-top: 9px;" href = "" onclick = "goback()">Back</button>
            </div>
        </div>
        <div class="main-content">
            <div class="row p-5">
                    <?php
                        require_once 'connectDB.php';
                        if(isset($_GET['paperType']))
                        {
                            if($_GET["paperType"]=="Prescription")
                            {
                                $idpat = $_GET["idpatient"];
                                $idphy = $_GET["idphysician"];
                                $papno = $_GET["paperNo"];
                                //echo $papno;
                                $x=mysqli_query($con,"SELECT pat.firstName as fnp,pat.lastName as lnp, lastUpdate, s.`status` as substatus, doc.firstName, doc.lastName, p.dateTime, p.drug, p.unit, p.dosage
                                                FROM prescription p, patient pat, subscriptions s, physician doc
                                                WHERE p.idpatient = pat.idpatient 
                                                        and s.paperNo = p.paperNo 
                                                        and s.paperNo = $papno
                                                        and p.idphysician = doc.idphysician
                                                GROUP BY p.idpatient, p.idphysician;");
                                echo ' <div class="col col-xl-12 mt-5">';
                                $datetime = new DateTime('today');
                                            while($row = $x->fetch_assoc()) 
                                            {
                                                //echo $row['substatus'];
                                                $lastDate =date_create($row["lastUpdate"]);
                                                $diff=date_diff($lastDate,$datetime);
                                                //echo "<h1>".$lastDate->format('Y-m-d')." ".$datetime->format('Y-m-d')."</h1>";
                                                $temp = date_create($lastDate->format("Y-m-d"));
                                                $interval = date_interval_create_from_date_string('30 days');
                                                $temp->add($interval);  
                                                $newdate = $temp->format("Y-m-d"); 
                                                $code = "".$newdate."_".$papno;
                                                //echo $code;
                                                echo '<div class = "jsHandle" id = '.$code.'><h5>Prescription</h5>';
                                                $new=mysqli_query($con,"SELECT pat.firstName as fnp,pat.lastName as lnp, lastUpdate, s.`status` as substatus, doc.firstName, doc.lastName, p.dateTime, p.drug, p.unit, p.dosage
                                                                        FROM prescription p, patient pat, subscriptions s, physician doc
                                                                        WHERE p.idpatient = pat.idpatient 
                                                                                and s.paperNo = p.paperNo 
                                                                                and s.paperNo = $papno
                                                                                and p.idphysician = doc.idphysician
                                                                                and p.idpatient = $idpat
                                                                        GROUP BY p.drug;");
                                                echo '<table class="table table-bordered">
                                                <thead>
                                                  <tr>
                                                    <th scope="col"><strong>Patient Name:</strong></th>
                                                    <th scope="col">'.$row["fnp"].' '.$row["lnp"].'</th>
                                                    <th scope="col"><strong>Physician Name:</strong></th>
                                                    <th scope="col">'.$row["firstName"].' '.$row["lastName"].'</th>
                                                  </tr>
                                                  <tr>
                                                    <th scope="col"><strong>Prescription Id:</strong></th>
                                                    <th scope="col">'.$papno.'</th>
                                                    <th scope="col"><strong>Date and Time:</strong></th>
                                                    <th scope="col">'.$row["lastUpdate"].'</th>
                                                  </tr>
                                                  <tr>
                                                    <th scope="col"><strong>Serial No</strong></th>
                                                    <th scope="col"><strong>Drug Name</strong></th>
                                                    <th scope="col"><strong>Unit</strong></th>
                                                    <th scope="col"><strong>Dosage</strong></th>
                                                  </tr>
                                                </thead>
                                                <tbody>';
                                                $count = 1;
                                                while($tuple = $new->fetch_assoc())
                                                {
                                                    echo '<tr>
                                                            <th scope="row">'.$count.'</th>
                                                            <td>'.$tuple['drug'].'</td>
                                                            <td>'.$tuple['unit'].'</td>
                                                            <td>'.$tuple['dosage'].'</td>
                                                        </tr>';
                                                    $count++;
                                                }
                                                echo'        </tbody>
                                                    </table>';
                                                if($row['substatus']=='pending')
                                                {
                                                    echo'      <div class="book mt-2" style="width: 100%;">
                                                                <div class="card" style="margin: auto;">
                                                                    <input type = "submit" class="form-control" onclick = "completion()" style = "color: rgb(253, 252, 250); background-color: rgb(9, 107, 99);" value = "Delivered" >
                                                                </div>
                                                            </div>
                                                        </div>';
                                                }
                                            }
                                echo '</div>';
                            }
                            else if($_GET["paperType"]=="LabReport")
                            {
                                $idpat = $_GET["idpatient"];
                                $papno = $_GET["paperNo"];
                                $x=mysqli_query($con,"  SELECT firstName,lastName,email,`dateTime`,s.status, appointmentId,report, lastUpdate
                                                        FROM subscriptions s, patient p, labreport l
                                                        WHERE l.appointmentId = s.paperNo and 
                                                                l.patientId = p.idpatient and
                                                                s.paperNo = $papno;");
                                //echo $x->num_rows;
                                if($x->num_rows>0)
                                {
                                    $row = $x->fetch_assoc();
                                    echo ' <div class="col col-xl-12 mt-5"><form action = "subComplete.php" method = "POST" enctype="multipart/form-data">';
                                    $datetime = new DateTime('today');
                                    $lastDate =date_create($row["lastUpdate"]);
                                    $diff=date_diff($lastDate,$datetime);
                                    //echo "<h1>".$lastDate->format('Y-m-d')." ".$datetime->format('Y-m-d')."</h1>";
                                    $temp = date_create($lastDate->format("Y-m-d"));
                                    $interval = date_interval_create_from_date_string('30 days');
                                    $temp->add($interval);  
                                    $newdate = $temp->format("Y-m-d"); 
                                                echo '<table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th scope="col"><strong>Patient Name:</strong></th>
                                                    <th scope="col">'.$row["firstName"].' '.$row["lastName"].'</th>
                                                    <th scope="col"><strong>Appointment Id:</strong></th>
                                                    <th scope="col">'.$row["appointmentId"].'</th>
                                                </tr>
                                                <tr>
                                                    <th scope="col"><strong>Patient email Id:</strong></th>
                                                    <th scope="col">'.$row["email"].'</th>
                                                    <th scope="col"><strong>Date and Time:</strong></th>
                                                    <th scope="col">'.$row["dateTime"].'</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th>Current Status</th>';
                                                        if($row['status']=='pending')
                                                        {
                                                            echo '  <th>Pending</th>
                                                                    <th>Action</th>
                                                                    <th>
                                                                        <div style="margin: auto;">
                                                                            
                                                                                <div class="row">
                                                                                    <div class="col col-xl-6">
                                                                                        <input type="file" name = "file" class="form-control-file" required>
                                                                                    </div>
                                                                                    <input type = "text" style = "display: none;" name = "data" value = "'.$row["appointmentId"].'">
                                                                                </div>
                                                                            
                                                                        </div>
                                                                    </th>';
                                                        }
                                                        else
                                                            echo '<th>Completed</th>
                                                                    <th>Report</th>
                                                                    <th>
                                                                        <img src="data:image/jpeg;base64,' . base64_encode($row["report"]) . '" style = "height: 200px;">
                                                                        
                                                                    </th>';
                                        echo '       
                                                    </tr>
                                                </tbody>
                                            </table>';
                                        if($row['status']=='pending')
                                        {
                                            echo'      <div class="book mt-2" style="width: 100%;">
                                                        <div class="card" style="margin: auto;">
                                                            <input type = "text" class = "d-none" name = "date" value = "'.$newdate.'">
                                                            <input type = "submit" class="form-control" name = "submit" style = "color: rgb(253, 252, 250); background-color: rgb(9, 107, 99);" value = "Submit" >
                                                        </div>
                                                    </div>';
                                        }
                                    echo '</form></div>';
                                }
                                else    
                                    echo '<h1>Cannot fetch the data</h1>';
                            }
                        }
                        else
                            echo "Can't fetch the data!!";
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>