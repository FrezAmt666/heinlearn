<?php 

try{
    $server_name = "localhost";
    $dbname = "blog_db";
    $dbuser = "root";
    $dbpassword = "";

    $dsn = "mysql:host=$server_name;dbname=$dbname";

    $conn = new PDO($dsn,$dbuser,$dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    
    // echo "Connection success";

}catch(PDOException $e){
    die("Connection fail: ". $e->getMessage());
}




   









?>