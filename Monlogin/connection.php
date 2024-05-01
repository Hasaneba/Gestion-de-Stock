<?php 
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $db_name = "gestion_stock_toplait";  
    $conn = new mysqli($servername, $username, $password, $db_name);
    if($conn->connect_error){
        die("Connection failed".$conn->connect_error);
    }
    echo "";
    
    ?>