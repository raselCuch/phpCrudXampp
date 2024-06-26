<?php
    // echo "hello2";
    $con = new mysqli( 'mysql_db', 'root' , 'root' , 'mysql');

    if($con){
    echo "Connected !!!";
    }
?>