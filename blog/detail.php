<?php 
include "nav.php";
require "QueryBuilder.php";
require "dbconnect.php";

$post_id = $_GET['id'];

$table = 'posts';   
 $cols = 'posts.*, categories.name as c_name, users.name as u_name';
 $join = 'INNER JOIN categories ON posts.category_id = categories.id INNER JOIN users ON posts.created_by = users.id';
 $id = $post_id;
 
 
 
 $post = show($table, $cols, $join, $id, $conn);
 $categories = select('categories','*',null, null, null, $conn);
//  var_dump($post);

?>


        <!-- Page content-->
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Post content-->
                    <article>
                        <!-- Post header-->
                        <header class="mb-4">
                            <!-- Post title-->
                            <h1 class="fw-bolder mb-1"><?= $post['title'] ?></h1>
                            <!-- Post meta content-->
                            <div class="text-muted fst-italic mb-2">
                                Posted on
                                <?php 
                                    $post_date_str = strtotime($post['post_date']);
                                    echo date('F d, Y', $post_date_str);
                                ?>
                                by <?= $post['u_name'] ?>
                            </div>
                            <!-- Post categories-->
                            <a class="badge bg-secondary text-decoration-none link-light" href="category_posts.php?id<?= $post['category_id'] ?>">#<?= $post['c_name'] ?></a>
                            
                        </header>
                        <!-- Preview image figure-->
                        <figure class="mb-4"><img class="img-fluid rounded" src="backend/<?= $post['image'] ?>" alt="..." /></figure>
                        <!-- Post content-->
                        <section>
                            <?= $post['description'] ?>
                        </section>
                        
                    </article>
                    
                </div>
            </div>

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
        </div>
                
                   
        

<?php 
    include "footer.php";
?>