<?php 

try{
    $server_name = "127.0.0.1:3308";
    $dbname = "todo";
    $dbuser = "root";
    $dbpassword = "";

    $dsn = "mysql:host=$server_name;dbname=$dbname";

    $conn = new PDO($dsn,$dbuser,$dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    
    echo "Connection success";

}catch(PDOException $e){
    die("Connection fail: ". $e->getMessage());
}




   









?>