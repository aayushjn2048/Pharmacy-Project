<?php
    $con=mysqli_connect("localhost","root","");
    if($con){
        $db=mysqli_select_db($con,'pharmacy');
        if(!$db)
        {
            echo"error in db selection";
        }
    }
    else
    {	
        echo "no connection found";
    }
?>