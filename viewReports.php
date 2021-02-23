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
        function viewData(blob)
        {
            const text = await (new Response(blob)).text();
            console.log(text);
        }
        function openPDF(resData, fileName) {
            var ieEDGE = navigator.userAgent.match(/Edge/g);
            var ie = navigator.userAgent.match(/.NET/g); // IE 11+
            var oldIE = navigator.userAgent.match(/MSIE/g); 
            var bytes = new Uint8Array(resData); //use this if data is raw bytes else directly pass resData
            var blob = new window.Blob([bytes], { type: 'application/pdf' });

            if (ie || oldIE || ieEDGE) {
               window.navigator.msSaveBlob(blob, fileName);
            }
            else {
               var fileURL = URL.createObjectURL(blob);
               var win = window.open();
               win.document.write('<iframe src="' + fileURL + '" frameborder="0" style="border:0; top:0px; left:0px; bottom:0px; right:0px; width:100%; height:100%;" allowfullscreen></iframe>')

            }
        }
        function downloadBlob(blob, name = 'file.txt') {
        // Convert your blob into a Blob URL (a special url that points to an object in the browser's memory)
            const blobUrl = URL.createObjectURL(blob);

            // Create a link element
            const link = document.createElement("a");

            // Set link's href to point to the Blob URL
            link.href = blobUrl;
            link.download = name;

            // Append link to the body
            document.body.appendChild(link);

            // Dispatch click event on the link
            // This is necessary as link.click() does not work on the latest firefox
            link.dispatchEvent(
                new MouseEvent('click', { 
                bubbles: true, 
                cancelable: true, 
                view: window 
                })
            );

            // Remove link from body
            document.body.removeChild(link);
        }
    </script>
</head>
<body>
    <div class="container-fluid px-3">
        <div class="fonted1 backgrounded1 p-2 pt-3">
            <h3>View Report</h3>
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
                        if(isset($_GET['appointmentId']))
                        {
                            $appId = $_GET["appointmentId"];
                            $x=mysqli_query($con,"  SELECT *
                                                    FROM labreport, patient
                                                    WHERE labreport.patientId = patient.idpatient and labreport.appointmentId = $appId;");
                            //echo $x->num_rows;
                            if($x->num_rows>0)
                            {
                                $row = $x->fetch_assoc();
                                echo ' <div class="col col-xl-12 mt-5"><form action = "reportComplete.php" method = "POST" enctype="multipart/form-data">';
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
                                                    if($row['status']=='Pending')
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
                                                                <th>Action</th>
                                                                <th>
                                                                    <img src="data:image;base64,' . base64_encode($row["report"]) . '" alter = "report" style = "height: 200px;">
                                                                    
                                                                </th>';
                                    echo '       
                                                </tr>
                                            </tbody>
                                          </table>';
                                    if($row['status']=='Pending')
                                    {
                                        echo'      <div class="book mt-2" style="width: 100%;">
                                                    <div class="card" style="margin: auto;">
                                                        <input type = "submit" class="form-control" name = "submit" style = "color: rgb(253, 252, 250); background-color: rgb(9, 107, 99);" value = "Submit" >
                                                    </div>
                                                </div>';
                                    }
                                echo '</form></div>';
                            }
                            else    
                                echo '<h1>Cannot fetch the data</h1>';
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