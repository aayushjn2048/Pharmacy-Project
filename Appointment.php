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
        button[type=submit]:focus,
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
        .date {
            padding-top: 0.8em;
            transition: 0.1s;
        }
        .date:hover {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
            background-color: rgb(9, 107, 99);
            color: rgb(253, 252, 250);
            border-radius: 10px;
        }
        .row1 .time {
            margin-top: 0.5em;
        }
        .time {
            padding-top: 8px;
            padding-bottom: 8px;
            transition: 0.1s;
        }
        .time:hover {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
            background-color: rgb(9, 107, 99);
            color: rgb(253, 252, 250);
            border-radius: 10px;
        }
        .col-sm-1half {
            position: relative;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
        }
        .selectedDate, .selectedTime {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
            background-color: rgb(9, 107, 99);
            color: rgb(253, 252, 250);
            border-radius: 10px;
        }
        @media (min-width: 768px) {
            .col-sm-1half {
                float: left;
            }
            .col-sm-1half {
                width: 9.7222222223%;
            }
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        function makeAppointment(idpat)
        {
            var getDate = document.getElementsByClassName('date');
            var myDate;
            var getTime = document.getElementsByClassName('time');
            var myTime;
            for(var i=0;i<getDate.length;i++)
            {
                if(getDate[i].classList.contains("selectedDate"))
                {
                    myDate = getDate[i].id;
                    break;
                }
            }
            for(var i=0;i<getTime.length;i++)
            {
                if(getTime[i].classList.contains("selectedTime"))
                {
                    myTime = (getTime[i].childNodes[3].innerHTML).split(' ');
                    break;
                }
            }
            var appid = "";
            for(var i=0;i<myDate.length;i++)
            {
                if(myDate[i]>='0'&&myDate[i]<=9)
                    appid = appid + myDate[i];
            }
            for(var i=0;i<myTime[0].length;i++)
            {
                if(myTime[0][i]>='0'&&myTime[0][i]<=9)
                    appid = appid + myTime[0][i];
            }
            appid = appid.substring(2,appid.length);
            //console.log(myDate,myTime[0],appid);
            location.href = "makeAppointment.php?appointmentId="+appid+"&date="+myDate+"&time="+myTime[0]+"&idPatient="+idpat;
        }
        function goback()
            {
                window.history.back();
            }
    </script>
</head>
<body>
<?php require_once 'connectDB.php';?>
    <div class="container-fluid px-3">
        <div class="fonted1 backgrounded1 p-2 pt-3">
            <h3>Appointment for Lab Test</h3>
        </div>
        <div class="card ml-1 mt-4" style = "border-radius: 5px; width: max-content;">
            <div>
                <button class = "btn" style = "background-color: white; line-height: 1em; padding-top: 9px;" href = "" onclick = "goback()">Back</button>
            </div>
        </div>
        <div class="main-content">
            <div class="profile mt-5" >
                <div class="content" style = "width: 100%; text-align: center;">
                    <img src = "assets/patient.jfif" class="rounded-circle" style="width: 100px; height: 100px;">
                    <h3><?php 
                            $myId = $_GET['idpatient'];
                            $x=mysqli_query($con,"  SELECT *
                                                    FROM  patient
                                                    WHERE patient.idpatient = $myId");
                            if ($x->num_rows > 0) 
                            {
                                while($row = $x->fetch_assoc())
                                {
                                    echo $row['firstName'].' '.$row['lastName'];
                                }
                            }
                            else    
                                echo $con->error;
                        ?></h3>
                    <p style = "color: grey;">Appointment for Blood Report</p>
                </div>
            </div>
            <div class="row" style="padding-top: 3em; margin-left: 6em;">
                <div class="col col-sm-12 col-md-12 col-xl-4 mt-2">
                    <?php
                        $datetime = new DateTime('today');
                        echo '<h4>'.$datetime->format('F Y').'</h4>';
                    ?>
                    <div class="row">
                        <?php
                            $count = 0;
                            while($count<6)
                            {
                                if($datetime->format('D')!="Sun")
                                {
                                    echo '  
                                            <div class="col col-sm-1half date" id = "'.$datetime->format('Y-m-d').'" onclick="dateFunc(this)" style="text-align: center;">
                                                <p>'.$datetime->format('D').'</p>
                                                <p>'.$datetime->format('j').'</p>
                                            </div>';
                                    $count++;
                                }
                                $datetime->add(new DateInterval("P1D"));
                            }
                        ?>
                        <div class="col col-sm-1half " style="text-align: center;">
                        </div>
                        <div class="col col-sm-1half " style="text-align: center;">
                        </div>
                    </div>
                </div>
                
                <div class="col col-sm-12 col-md-6 col-xl-4 mt-2">
                    <h4>Morning</h4>
                    <div class="row row1">
                        <div class="col col-3 time" onclick="timeFunc(this)">
                            <div style="display: inline-flex;">
                                <svg xmlns="http://www.w3.org/2000/svg" style = "padding-top: 4px;" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                </svg>
                            </div>
                            <p style="display: inline-flex; margin: 0;">08:30 AM</p>
                        </div>
                        <div class="col col-3 time" onclick="timeFunc(this)">
                            <div style="display: inline-flex;">
                                <svg xmlns="http://www.w3.org/2000/svg" style = "padding-top: 4px;" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                </svg>
                            </div>
                            <p style="display: inline-flex; margin: 0;">09:00 AM</p>
                        </div>
                        <div class="col col-3 time" onclick="timeFunc(this)">
                            <div style="display: inline-flex;">
                                <svg xmlns="http://www.w3.org/2000/svg" style = "padding-top: 4px;" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                </svg>
                            </div>
                            <p style="display: inline-flex; margin: 0;">09:30 AM</p>
                        </div>
                        <div class="col col-3"></div>
                    </div>
                    <div class="row">
                        <div class="col col-3 time" onclick="timeFunc(this)">
                            <div style="display: inline-flex;">
                                <svg xmlns="http://www.w3.org/2000/svg" style = "padding-top: 4px;" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                </svg>
                            </div>
                            <p style="display: inline-flex; margin: 0;">10:00 AM</p>
                        </div>
                        <div class="col col-3 time" onclick="timeFunc(this)">
                            <div style="display: inline-flex;">
                                <svg xmlns="http://www.w3.org/2000/svg" style = "padding-top: 4px;" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                </svg>
                            </div>
                            <p style="display: inline-flex; margin: 0;">10:30 AM</p>
                        </div>
                        <div class="col col-3 time" onclick="timeFunc(this)">
                            <div style="display: inline-flex;">
                                <svg xmlns="http://www.w3.org/2000/svg" style = "padding-top: 4px;" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                </svg>
                            </div>
                            <p style="display: inline-flex; margin: 0;">11:00 AM</p>
                        </div>
                        <div class="col col-3"></div>
                    </div>
                </div>
                <div class="col col-sm-12 col-md-6 col-xl-4 mt-2">
                    <h4>Evening</h4>
                    <div class="row row1">
                        <div class="col col-3 time" onclick="timeFunc(this)">
                            <div style="display: inline-flex;">
                                <svg xmlns="http://www.w3.org/2000/svg" style = "padding-top: 4px;" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                </svg>
                            </div>
                            <p style="display: inline-flex; margin: 0;">05:30 PM</p>
                        </div>
                        <div class="col col-3 time" onclick="timeFunc(this)">
                            <div style="display: inline-flex;">
                                <svg xmlns="http://www.w3.org/2000/svg" style = "padding-top: 4px;" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                </svg>
                            </div>
                            <p style="display: inline-flex; margin: 0;">06:00 PM</p>
                        </div>
                        <div class="col col-3 time" onclick="timeFunc(this)">
                            <div style="display: inline-flex;">
                                <svg xmlns="http://www.w3.org/2000/svg" style = "padding-top: 4px;" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                </svg>
                            </div>
                            <p style="display: inline-flex; margin: 0;">06:30 PM</p>
                        </div>
                        <div class="col col-3"></div>
                    </div>
                    <div class="row">
                        <div class="col col-3 time" onclick="timeFunc(this)">
                            <div style="display: inline-flex;">
                                <svg xmlns="http://www.w3.org/2000/svg" style = "padding-top: 4px;" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                </svg>
                            </div>
                            <p style="display: inline-flex; margin: 0;">07:00 PM</p>
                        </div>
                        <div class="col col-3 time" onclick="timeFunc(this)">
                            <div style="display: inline-flex;">
                                <svg xmlns="http://www.w3.org/2000/svg" style = "padding-top: 4px;" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                </svg>
                            </div>
                            <p style="display: inline-flex; margin: 0;">07:30 PM</p>
                        </div>
                        <div class="col col-3 time" onclick="timeFunc(this)">
                            <div style="display: inline-flex;">
                                <svg xmlns="http://www.w3.org/2000/svg" style = "padding-top: 4px;" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                </svg>
                            </div>
                            <p style="display: inline-flex; margin: 0;">08:00 PM</p>
                        </div>
                        <div class="col col-3"></div>
                    </div>
                </div>
            </div>
            <div class="book mt-5" style="width: 100%;">
                <div class="card" style="margin: auto;">
                    <input type = "submit" class="form-control" onclick = "makeAppointment(<?php echo $myId?>)" style = "color: rgb(253, 252, 250); background-color: rgb(9, 107, 99);" value = "Book an Appointment" >
                </div>
            </div>
        </div>
    </div>
    <script type = "text/javascript">
        function dateFunc(mydom)
        {
            var x = document.getElementsByClassName("date");
            for(var i=0;i<x.length;i++)
            {
                if(x[i].classList.contains("selectedDate"))
                    x[i].classList.remove("selectedDate")
            }
            mydom.classList.add("selectedDate");
        }
        function timeFunc(mydom)
        {
            var x = document.getElementsByClassName("time");
            for(var i=0;i<x.length;i++)
            {
                if(x[i].classList.contains("selectedTime"))
                    x[i].classList.remove("selectedTime")
            }
            mydom.classList.add("selectedTime");
        }
    </script>
</body>
</html>