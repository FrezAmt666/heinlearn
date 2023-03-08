<?php 
    include "dbconnect.php";

    $id = $_POST['task_id'];
    $task = $_POST['task'];

    // echo $id;
    // echo $task;

    $sql = "UPDATE lists SET task = :task WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':task',$task);
    $stmt->bindParam(':id',$id);
    $stmt->execute();

    header("location:index.php");


?>