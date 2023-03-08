<?php

session_start();
if(isset($_SESSION['user_id'])){
    include "../dbconnect.php";
    include "../QueryBuilder.php";


    
    $users = select("users", "*", null, null, null, $conn);
    // echo "<pre>";
    // print_r($posts);
    // echo "</pre>";
    if(isset($_POST['task_id'])){
        $id = $_POST['task_id'];
        delete("users", $id, $conn);
        header("location: users.php");
    }


    include "nav.php";
?>
                <main>
                    <div class="container-fluid px-4">
                        
                        
                        <div class="card my-4">
                            <div class="card-header">
                                <p class="d-inline">User Lists</p>
                                <a href="user_create.php" class="btn btn-primary btn-sm float-end">User Create</a>
                                
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $no=1;
                                            foreach($users as $user){  
                                    
                                        ?>
                                            <tr>
                                                <td><?php echo $no++ ?></td>
                                                <td><?php echo $user["name"] ?></td>
                                                <td><?php echo $user["email"] ?></td>
                                                <td><?php echo $user["password"] ?></td>
                                                <td>
                                                    <a href="user_edit.php?id=<?php echo $user['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                                    <button class="btn btn-sm btn-danger task_del"  data-id="<?php echo $user['id'] ?>" data-bs-toggle="modal" data-bs-target="#deleteModal" ><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        <?php 
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>


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
                            <form action="users.php" method="post">
                                <input type="hidden" value="" id="task_id" name="task_id">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            
                        </div>
                        </div>
                    </div>
                </div>

                


<?php

    include "footer.php";
                                    }
                                    else{
                                        header("location:login.php");
                                    }
?>