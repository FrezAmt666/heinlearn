<?php
    require "../dbconnect.php";
    require "../QueryBuilder.php";

    session_start();
    if(isset($_SESSION['user_id'])){

    $table = 'posts';
    $cols = 'posts.*, categories.name as c_name, users.name as u_name';
    $join = 'INNER JOIN categories ON posts.category_id = categories.id INNER JOIN users ON posts.created_by = users.id';
    $where = null;
    $order = 'id DESC';
    
    
    $posts = select($table, $cols, $join, $where, $order, $conn);

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        delete('posts', $id, $conn);
        header('location: posts.php');
    }

    
    // $sql = "SELECT posts.*, categories.name as c_name, users.name as u_name from posts INNER JOIN categories ON posts.category_id = categories.id INNER JOIN users ON posts.created_by = users.id";
    // $stmt = $conn->prepare($sql);
    // $stmt->execute();
    // $posts = $stmt->fetchAll();

    include "nav.php";
    // var_dump($posts);
?>
            
                <main>
                    <div class="container-fluid px-4">
                        
                        
                        <div class="card my-4">
                            <div class="card-header">
                                <p class="d-inline">Post Lists</p>
                                <a href="post_create.php" class="btn btn-primary btn-sm float-end">Post Create</a>
                                
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>C_name</th>
                                            <th>U_name</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $no=1;
                                            foreach($posts as $post){  
                                                
                
                                        ?>
                                            <tr>
                                                <td><?php echo $no++ ?></td>
                                                <td><?php echo $post["title"] ?></td>
                                            
                                                <td><?php echo $post["c_name"] ?></td>
                                                <td><?php echo $post["u_name"] ?></td>
                                                <td>
                                                    <a href="post_edit.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                                    <button class="task_del btn btn-sm btn-danger" data-id="<?= $post['id'] ?>" data-bs-toggle="modal" data-bs-target="#postDelete">Delete</button>
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
                
                <div class="modal fade" id="postDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <form action="posts.php" method="post">
                                <input type="hidden" value="" id="task_id" name="id">
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