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
                    var data = code.split('-');
                    location.href = "makeComplete.php?idphy="+data[0]+"&idpat="+data[1]+"&papno="+data[2];
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
            <h3>View Prescriptions</h3>
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
                            if($_GET["paperType"]=="Doctor")
                            {
                                echo '<div class="col col-sm-12 col-md-6 col-xl-4 mt-5"><h5>Prescriptions by Doctors</h5>';
                                $idphy = $_GET["idphysician"];
                                $x=mysqli_query($con,"  SELECT *
                                                FROM prescription, 
                                                    (SELECT idpatient AS idp, firstName as fnp, lastName as lnp FROM patient) patient, 
                                                    physician 
                                                WHERE prescription.idpatient = patient.idp and prescription.idphysician = physician.idphysician and prescription.idphysician = $idphy
                                                GROUP BY prescription.idpatient, prescription.idphysician;");
                                if ($x->num_rows > 0) 
                                {
                                    //echo $x->num_rows;
                                    while($row = $x->fetch_assoc()) 
                                    {
                                        //print_r($row);
                                        echo '  <style>
                                                    .status-badge{
                                                        position: absolute;
                                                        right:-1em;
                                                        text-align: center;
                                                    }
                                                </style>
                                                <div class="card" onclick = "removeNone(\''.$row['idphysician'].'\',\''.$row['idpatient'].'\',\''.$row['paperNo'].'\')">
                                                    <div class="row">
                                                        <div class="col col-2" style="margin: 0.5em;">';
                                                    if($row['status']=="Pending")
                                                    {
                                                        echo   '<span class="badge badge-warning status-badge">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                                                                    <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                                                                    <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
                                                                </svg>';
                                                    }
                                                    else if($row['status'] == "Ready")
                                                    {
                                                        echo '<span class="badge badge-primary status-badge">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hourglass-split" viewBox="0 0 16 16">
                                                                    <path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2h-7zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48V8.35zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z"/>
                                                                </svg>';
                                                    }
                                                    else 
                                                    {
                                                        echo '<span class="badge badge-success status-badge">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                                                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                                                                </svg>';
                                                    }
                                        echo               '</span>
                                                            <img src = "assets/prescription.png" style="height: 3em;">
                                                            
                                                        </div>
                                                        <div class="col col-7" style="margin: auto;">
                                                            <p style="margin: 0; font-size: 0.75em;"><strong>Physician: '.$row["firstName"].' '.$row["lastName"].'</strong></p>
                                                            <p style="margin: 0; font-size: 0.7em;">Patient: '.$row["fnp"].' '.$row["lnp"].'</p>
                                                            </div>
                                                            <div class="col col-2" style="margin: auto;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="grey" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                                                    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>';
                                    }
                                } else {
                                    echo "No prescription generated by the physician";
                                }
                                $x=mysqli_query($con,"  SELECT *
                                                FROM prescription, 
                                                    (SELECT idpatient AS idp, firstName as fnp, lastName as lnp FROM patient) patient, 
                                                    physician 
                                                WHERE prescription.idpatient = patient.idp and prescription.idphysician = physician.idphysician and prescription.idphysician = $idphy
                                                GROUP BY prescription.idpatient, prescription.idphysician;");
                                echo '  </div><div class="col col-md-12 col-xl-8 mt-5">';
                                            while($row = $x->fetch_assoc()) 
                                            {
                                                $code = "".$row['idphysician']."-".$row['idpatient']."-".$row['paperNo'];
                                                echo '<div class = "d-none jsHandle" id = '.$code.'><h5>Prescription</h5>';
                                                $papNos = $row["paperNo"];
                                                $idPat = $row["idpatient"];
                                                $new = mysqli_query($con,"  SELECT *
                                                FROM prescription, 
                                                    (SELECT idpatient AS idp, firstName as fnp, lastName as lnp FROM patient) patient, 
                                                    physician 
                                                WHERE prescription.idpatient = patient.idp and 
                                                        prescription.idphysician = physician.idphysician and 
                                                        prescription.idphysician = $idphy and 
                                                        prescription.paperNo = $papNos and
                                                        prescription.idpatient = $idPat;");
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
                                                    <th scope="col">'.$row["paperNo"].'</th>
                                                    <th scope="col"><strong>Date and Time:</strong></th>
                                                    <th scope="col">'.$row["dateTime"].'</th>
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
                                        if($row['status']=='Pending')
                                        {
                                            echo'      <div class="book mt-2" style="width: 100%;">
                                                            <div class="card" style="margin: auto;">
                                                                <input type = "submit" class="form-control" onclick = "completion()" style = "color: rgb(253, 252, 250); background-color: rgb(9, 107, 99);" value = "Delivered" >
                                                            </div>
                                                        </div>';
                                                }
                                        echo '</div>';
                                        }
                                echo '</div>';
                            }
                            else if($_GET["paperType"]=="Patient")
                            {
                                echo '<div class="col col-sm-12 col-md-6 col-xl-4 mt-5"><h5>Prescription for Patients</h5>';
                                $idpat = $_GET["idpatient"];
                                $x=mysqli_query($con,"  SELECT *
                                                FROM prescription, 
                                                    (SELECT idpatient AS idp, firstName as fnp, lastName as lnp FROM patient) patient, 
                                                    physician 
                                                WHERE prescription.idpatient = patient.idp and prescription.idphysician = physician.idphysician and prescription.idpatient = $idpat
                                                GROUP BY prescription.idpatient, prescription.idphysician;");
                                if ($x->num_rows > 0) 
                                {
                                    //echo $x->num_rows;
                                    while($row = $x->fetch_assoc()) 
                                    {
                                        //print_r($row);
                                        echo '  <style>
                                                    .status-badge{
                                                        position: absolute;
                                                        right:-1em;
                                                        text-align: center;
                                                    }
                                                </style>
                                                <div class="card" onclick = "removeNone(\''.$row['idphysician'].'\',\''.$row['idpatient'].'\',\''.$row['paperNo'].'\')">
                                                    <div class="row">
                                                        <div class="col col-2" style="margin: 0.5em;">';
                                                    if($row['status']=="Pending")
                                                    {
                                                        echo   '<span class="badge badge-warning status-badge">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                                                                    <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                                                                    <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
                                                                </svg>';
                                                    }
                                                    else if($row['status'] == "Ready")
                                                    {
                                                        echo '<span class="badge badge-primary status-badge">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hourglass-split" viewBox="0 0 16 16">
                                                                    <path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2h-7zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48V8.35zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z"/>
                                                                </svg>';
                                                    }
                                                    else if($row['status'] == "Successful")
                                                    {
                                                        echo '<span class="badge badge-success status-badge">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                                                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                                                                </svg>';
                                                    }
                                        echo               '</span>
                                                            <img src = "assets/prescription.png" style="height: 3em;">
                                                            
                                                        </div>
                                                        <div class="col col-7" style="margin: auto;">
                                                            <p style="margin: 0; font-size: 0.75em;"><strong>Physician: '.$row["firstName"].' '.$row["lastName"].'</strong></p>
                                                            <p style="margin: 0; font-size: 0.7em;">Patient: '.$row["fnp"].' '.$row["lnp"].'</p>
                                                            </div>
                                                            <div class="col col-2" style="margin: auto;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="grey" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                                                    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>';
                                    }
                                } else {
                                    echo "No prescription are registered for the patient";
                                }
                                $x=mysqli_query($con,"  SELECT *
                                                FROM prescription, 
                                                    (SELECT idpatient AS idp, firstName as fnp, lastName as lnp FROM patient) patient, 
                                                    physician 
                                                WHERE prescription.idpatient = patient.idp and prescription.idphysician = physician.idphysician and prescription.idpatient = $idpat
                                                GROUP BY prescription.idpatient, prescription.idphysician;");
                                echo '  </div><div class="col col-md-12 col-xl-8 mt-5">';
                                            while($row = $x->fetch_assoc()) 
                                            {
                                                $code = "".$row['idphysician']."-".$row['idpatient']."-".$row['paperNo'];
                                                echo '<div class = "d-none jsHandle" id = '.$code.'><h5>Prescription</h5>';
                                                $papNos = $row["paperNo"];
                                                $idphy = $row["idphysician"];
                                                $new = mysqli_query($con,"  SELECT *
                                                FROM prescription, 
                                                    (SELECT idpatient AS idp, firstName as fnp, lastName as lnp FROM patient) patient, 
                                                    physician 
                                                WHERE prescription.idpatient = patient.idp and 
                                                        prescription.idphysician = physician.idphysician and 
                                                        prescription.idphysician = $idphy and 
                                                        prescription.paperNo = $papNos and
                                                        prescription.idpatient = $idpat;");
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
                                                    <th scope="col">'.$row["paperNo"].'</th>
                                                    <th scope="col"><strong>Date and Time:</strong></th>
                                                    <th scope="col">'.$row["dateTime"].'</th>
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
                                        if($row['status']=='Pending')
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
                            else if($_GET["paperType"]=="Prescription")
                            {
                                $idpat = $_GET["idpatient"];
                                $idphy = $_GET["idphysician"];
                                $papno = $_GET["paperNo"];
                                $x=mysqli_query($con,"  SELECT *
                                                FROM prescription, 
                                                    (SELECT idpatient AS idp, firstName as fnp, lastName as lnp FROM patient) patient, 
                                                    physician 
                                                WHERE prescription.idpatient = patient.idp and prescription.idphysician = physician.idphysician and prescription.idpatient = $idpat and prescription.idphysician = $idphy and prescription.paperNo = $papno
                                                GROUP BY prescription.idpatient, prescription.idphysician;");
                                //echo $x->num_rows;
                                echo ' <div class="col col-xl-12 mt-5">';
                                            while($row = $x->fetch_assoc()) 
                                            {
                                                $code = "".$row['idphysician']."-".$row['idpatient']."-".$row['paperNo'];
                                                //echo $code;
                                                echo '<div class = "jsHandle" id = '.$code.'><h5>Prescription</h5>';
                                                $new = mysqli_query($con,"  SELECT *
                                                                            FROM prescription, 
                                                                                (SELECT idpatient AS idp, firstName as fnp, lastName as lnp FROM patient) patient, 
                                                                                physician 
                                                                            WHERE prescription.idpatient = patient.idp and 
                                                                                    prescription.idphysician = physician.idphysician and 
                                                                                    prescription.idphysician = $idphy and 
                                                                                    prescription.paperNo = $papno and
                                                                                    prescription.idpatient = $idpat;");
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
                                                    <th scope="col">'.$row["paperNo"].'</th>
                                                    <th scope="col"><strong>Date and Time:</strong></th>
                                                    <th scope="col">'.$row["dateTime"].'</th>
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
                                        if($row['status']=='Pending')
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