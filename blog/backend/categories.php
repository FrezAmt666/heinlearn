<?php

session_start();
if(isset($_SESSION['user_id'])){
    include "../dbconnect.php";
    include "../QueryBuilder.php";

    $categories = select("categories", "*", null,null, null, $conn);

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        delete('categories', $id, $conn);
        header('location: categories.php');
    }


    include "nav.php";
?>
 <main>
                    <div class="container-fluid px-4">
                        
                        
                        <div class="card my-4">
                            <div class="card-header">
                                <p class="d-inline">Category Lists</p>
                                <a href="category_create.php" class="btn btn-primary btn-sm float-end">Category Create</a>
                                
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Action</th>
    
                                            
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php 
                                            $no=1;
                                            foreach($categories as $category){  
                                                
                                        
                                        ?>
                                            <tr>
                                                <td><?php echo $no++ ?></td>
                                                <td><?php echo $category["name"] ?></td>
                                                <td>
                                                    <a href="category_edit.php?id=<?php echo $category['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                                    <button class="task_del btn btn-sm btn-danger" data-id="<?= $category['id'] ?>" data-bs-toggle="modal" data-bs-target="#categoryDelete">Delete</button>
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
                <div class="modal fade" id="categoryDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <form action="categories.php" method="post">
                                <input type="text" value="" id="task_id" name="id">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            
                        </div>
                        </div>
                    </div>
                </div>

<?php

    include "footer.php";
    }else{
        header("location:login.php");
    }
?>