<?php 

include "nav.php";
 require "QueryBuilder.php";
 require "dbconnect.php";

 $table = 'posts';
 $cols = 'posts.*, categories.name as c_name, users.name as u_name';
 $join = 'INNER JOIN categories ON posts.category_id = categories.id INNER JOIN users ON posts.created_by = users.id';
 $where = null;
 $order = 'id DESC';
 
 
 $posts = select($table, $cols, $join, $where, $order, $conn);
 $categories = select('categories','*',null, null, null, $conn);

?>



        <header class="py-5 bg-light border-bottom mb-4">
            <div class="container">
                <div class="text-center my-5">
                    <h1 class="fw-bolder">Welcome to Hein Blog!</h1>
                    <p class="lead mb-0">Knowledge is power , Sharing is superpower.</p>
                </div>
            </div>
        </header>
        <div class="container">
            <div class="row">
                
            <div class="col-lg-8">
                    <!-- Featured blog post-->
                    <?php
                         foreach($posts as $post){

    
                    ?>  
                    <div class="card mb-4">
                        <a href="#!"><img class="card-img-top" src="backend/<?= $post['image'] ?>" alt="..." /></a>
                        <div class="card-body">
                            <div class="small text-muted">
                                <?php $post_date_str = strtotime($post['post_date']);
                                echo date('F,d,Y', $post_date_str)
                                ?>
                                <a href="category_posts.php?id=<?= $post['category_id'] ?>" class="d-block">#<?= $post['c_name'] ?></a>
                            </div>
                            
                            <h2 class="card-title"><?php echo $post['title'] ?></h2>
                            <!-- <p class="card-text"><?php echo $post['description'] ?></p> -->
                            <a class="btn btn-primary" href="detail.php?id=<?= $post['id'] ?>">Read more →</a>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                    
                    
                </div>
                

                <!-- Side widgets-->
                <div class="col-lg-4">
                    
                    <!-- Categories widget-->
                    <div class="card mb-4">
                        <div class="card-header">Categories</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <?php
                                            foreach($categories as $category){
                                        ?>
                                        <li><a href="category_posts.php?id=<?= $category['id']?>">#<?php echo $category['name']  ?></a></li>
                                        <?php
                                             }

                                        ?>
                                    </ul>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                    
                
                

<?php
include "footer.php";


?>

