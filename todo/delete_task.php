<?php 
    include "dbconnect.php";

    $id = $_POST['task_id'];
    $sql = "DELETE FROM lists WHERE id=:id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id',$id);
    $stmt->execute();
    header("location:index.php");


?>