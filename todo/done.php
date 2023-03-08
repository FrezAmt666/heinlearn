<?php 

    include "dbconnect.php";

    $id = $_POST['task_id'];
    $status = 1;

    // echo $list;

    $sql = "UPDATE lists SET status = :status WHERE id =:id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':status',$status);
    $stmt->bindParam(':id',$id);
    $stmt->execute();

    header("location:index.php");

?>