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
            width: 16em;
            margin-left: auto;
            margin-right: auto;
            margin-top: 1em;
            margin-bottom: 1em;
        }
        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
    <?php require_once 'connectDB.php';?>
    <div class="container-fluid px-3">
        <div class="fonted1 backgrounded1 p-2 pt-3">
            <h3>Pharmacist Register</h3>
        </div>
        <div class="loginForm" style = "margin-top: 10%;">
            <?php
                if(isset($_POST['register']))
                {
                    echo '<script>alert("Its working!!!!);</script>';
                    if(isset($_POST['username']))
                    {
                        if($_POST['cpassword'] != $_POST['password'])
                        {
                            $html = '<div id="errorPlace" style = "text-align: center; color: red;"></div>';
                            libxml_use_internal_errors(true);
                            $doc = new DOMDocument(); 
                            $doc->loadHTML($html);
                            //get the element you want to append to
                            $descBox = $doc->getElementById('errorPlace');
                            //create the element to append to #element1
                            $appended = $doc->createElement('p', 'Password should be same');
                            //actually append the element
                            $descBox->appendChild($appended);
                            echo $doc->saveHTML();
                        }
                        else
                        {
                            $myusername = $_POST['username'];
                            $pass = md5($_POST['password']);
                            $checkQuery = mysqli_query($con,"select * from pharmacist where username = '{$_POST['username']}'");
                            $result=$checkQuery->num_rows;
                            if($result==0)
                            {
                                $query="insert into pharmacist (username,password) values('$myusername','$pass')";
                                $x=mysqli_query($con,$query);
                                //echo "Value of query: ".$query;
                                if(!$x)
                                {
                                    echo "<script>alert('Error while registering');</script>";
                                }
                                else
                                {
                                    echo "<script>alert('User registered successfully'); window.location = 'PharmacistLogin.php'</script>";
                                    if(!isset($_SESSION['active']))
                                    {
                                        $_SESSION['active'] = "YES";
                                    }
                                }
                            }
                            else   
                                echo "<script>alert('Username already taken');</script>";
                        }
                    }
                }
            ?>
            <form action="PharmacistRegister.php" method = "POST">
                <div class="card">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text p-2" style = "background-color: rgb(9, 107, 99); border-bottom-right-radius: 5px; border-top-right-radius: 5px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="rgb(243, 240, 235)" class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                </svg>
                            </div>
                        </div>
                        <input type="text" name = "username" class="form-control" style = "border: none;" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="Username" required>
                    </div>
                </div>
                <div class="card">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text p-2" style = "background-color: rgb(9, 107, 99); border-bottom-right-radius: 5px; border-top-right-radius: 5px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="rgb(253, 252, 250)" class="bi bi-key-fill" viewBox="0 0 16 16">
                                    <path d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                </svg>
                            </div>
                        </div>
                        <input type="password" name = "password" class="form-control" style = "border: none;" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="Password" required>
                    </div>
                </div>
                <div class="card">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text p-2" style = "background-color: rgb(9, 107, 99); border-bottom-right-radius: 5px; border-top-right-radius: 5px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="rgb(253, 252, 250)" class="bi bi-key-fill" viewBox="0 0 16 16">
                                    <path d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                </svg>
                            </div>
                        </div>
                        <input type="password" name = "cpassword" class="form-control" style = "border: none;" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="Confirm Password" required>
                    </div>
                </div>
                <div class="card">
                    <input type = "submit" name = "register" class="form-control" style = "color: rgb(253, 252, 250); background-color: rgb(9, 107, 99);" value = "Register" >
                </div>
            </form>
            <div style = "margin-top: 2em; text-align: center;">
                <p>Already a member? <a href = "PharmacistLogin.php" style = "color: inherit;"><u>Log In</u></a></p>
            </div>
        </div>
    </div>
</body>
</html>