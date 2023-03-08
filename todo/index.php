<?php 
    include "dbconnect.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $task = $_POST['task'];
        // echo $task;
        $status = 0;

        $sql = "INSERT INTO lists (task,status) VALUES(:task,:status)";
        $stmt =   $conn->prepare($sql);
        $stmt->bindParam(':task',$task);
        $stmt->bindParam(':status',$status);
        $stmt->execute();
        header("location:index.php");

    }else{

    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>ToDo List</title>
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center pb-5">ToDo Lists</h1>
        <div class="row">
            <div class="offset-md-3 col-md-6">
                <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                    <div class="row">
                        <div class="col-md-8">
                        <div class="mb-3">
                            <input type="text" class="form-control" id="task" placeholder="Enter Task" name="task">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">Add Task</button>
                        </div>
                    </div>
                </form>

                <table class="table my-5">
                    <?php 
                        $sql="SELECT * FROM lists";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $lists = $stmt->fetchALL();
                    
                        // var_dump($stmt);
                        $i = 1;
                        foreach($lists as $list){
                            // echo $list['status'];
                        

                    ?>
                    
                    <tr>
                        <td><?php echo $i++?></td>
                        <td class="<?php if($list['status'] == 1) echo 'text-decoration-line-through' ?>"><?php echo $list['task']?></td>
                        <td>
                            <form action="done.php" method="POST" class="d-inline">
                            <input type="hidden" name="task_id" value="<?php echo $list['id']  ?>">
                            <button class="btn btn-sm btn-success" type="submit"><i class="fas fa-check"></i></button>
                            </form>
                            
                            <button class="btn btn-sm btn-warning task_edit" data-id="<?php echo $list['id'] ?>" data-task="<?php echo $list['task']  ?>"><i class="fas fa-pen"></i></button>
                            <button class="btn btn-sm btn-danger task_del"  data-id="<?php echo $list['id'] ?>" ><i class="fas fa-trash"></i></button>
                            
                    </td>
                    </tr>

                    <?php 
                        }
                    ?>
                </table>

            </div>
        </div>
    </div>

    <!-- delete  Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger task-white">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Task</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h3 class="text-center py-3">Are you sure delete? </h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form action="delete_task.php" method="post">
            <input type="hidden" value="" id="task_id" name="task_id">
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        
      </div>
    </div>
  </div>
</div>

<!--Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Text Edit</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="update_task.php" method="post">
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <input type="hidden" name="task_id" id="edit_id">
                        <input type="text" class="form-control" id="edit_task" placeholder="Enter Task" name="task">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-warning">Update Task</button>
                    </div>
                </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
            //task delete
            $('.task_del').click(function(){
                $id = $(this).data('id');
                $('#task_id').val($id);
                $('#deleteModal').modal('show');
            })

            //task edit
            $('.task_edit').click(function(){

                $id = $(this).data('id');
                $task= $(this).data('task');
                $('#edit_task').val($task);
                $('#edit_id').val($id)
                console.log($id , $task);
                $('#editModal').modal('show');
            })
        });
    </script>
</body>
</html>


