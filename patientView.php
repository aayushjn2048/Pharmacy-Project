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
        function removeNone(idpat)
        {
            var x = document.getElementsByClassName('jsHandle');
            for(var i=0;i<x.length;i++)
            {
                if(!x[i].classList.contains('d-none'))
                    x[i].classList.add("d-none");
            }
            var code = ""+idpat;
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
            <h3>Patient Details</h3>
        </div>
        <div class="card ml-1 mt-4" style = "border-radius: 5px; width: max-content">
            <div style = "position: absolute; float:left;">
                <button class = "btn" style = "background-color: white; line-height: 1em; padding-top: 9px;" href = "" onclick = "goback()">Back</button>
            </div>
            <div class="topnav" style = "margin-left: 3.8em;">
                <a style = "padding-top: 5px; padding-bottom: 5px;" href="ViewPrescriptions.php">Prescriptions</a>
                <a style = "padding-top: 5px; padding-bottom: 5px;" href="labReport.php">Lab Reports</a>
                <a style = "padding-top: 5px; padding-bottom: 5px;" href="subscription.php">Subscriptions</a>
                <a style = "padding-top: 5px; padding-bottom: 5px;" class="active" href="patientView.php">Patients</a>
                <a style = "padding-top: 5px; padding-bottom: 5px;" href="PharmacistLogin.php">Logout</a>
            </div>
        </div>
        <div class="main-content">
            <div class="row p-5">
                    <?php
                        require_once 'connectDB.php';
                        echo '<div class="col col-sm-12 col-md-6 col-xl-4 mt-5"><h5>Patient</h5>';
                        $x=mysqli_query($con,"  SELECT * FROM patient;");
                        if ($x->num_rows > 0) 
                        {
                            //echo $x->num_rows;
                            while($row = $x->fetch_assoc()) 
                            {
                                //print_r($row);
                                echo '  <div class="card" onclick = "removeNone(\''.$row['idpatient'].'\')">
                                            <div class="row">
                                                <div class="col col-2" style="margin: 0.5em;">
                                                    <img src = "assets/img.jfif" style="height: 3em;">
                                                </div>
                                                <div class="col col-7" style="margin: auto;">
                                                    <p style="margin: 0; font-size: 0.75em;"><strong>'.$row["firstName"].' '.$row["lastName"].'</strong></p>
                                                    <p style="margin: 0; font-size: 0.7em;">Patient</p>
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
                        $x=mysqli_query($con,"  SELECT * FROM patient;");
                        echo '  </div><div class="col col-md-12 col-xl-8 mt-5">';
                                    while($row = $x->fetch_assoc()) 
                                    {
                                        $code = "".$row['idpatient'];
                                        echo '<div class = "d-none jsHandle" id = '.$code.'><h5>Details</h5>
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="col"><strong>Patient Id:</strong></th>
                                                            <th scope="col">'.$row["idpatient"].'</th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col"><strong>Patient Name:</strong></th>
                                                            <th scope="col">'.$row["firstName"].' '.$row["lastName"].'</th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col"><strong>Patient Username:</strong></th>
                                                            <th scope="col">'.$row["username"].'</th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col"><strong>Patient email:</strong></th>
                                                            <th scope="col">'.$row["email"].'</th>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                              </div>';
                                }
                        echo '</div>';
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>