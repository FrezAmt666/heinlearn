<?php 
 session_start();
 if(isset($_SESSION['user_id'])){
    require "../dbconnect.php";
    require "../QueryBuilder.php";

    $id = $_GET['id'];

   
    $post = edit('posts', $id, $conn);



    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $title = $_POST['title'];
        $image_arr = $_FILES['image'];
        $category_id = $_POST['category_id'];
        $description = $_POST['description'];

        echo "$title, $category_id, $description <br>";
        echo $_POST['old_photo'];
        print_r($image_arr);
        echo $image_arr['size'];
    
        if(isset($image_arr) && $image_arr['size']>0){
            $dir = "images/";
            $image = $dir.$image_arr['name'];
            $tmp_name = $image_arr['tmp_name'];
            move_uploaded_file($tmp_name, $image);
        }else{
            $image =$_POST['old_photo'];
        }
    
        $post_date = date("Y-m-d");
        $created_by = 2;
        $updated_by = 2;

        
        $datas = [
            "title" =>  $title,
            "image" => $image,
            "description" => $description,
            "post_date"=> $post_date,
            "category_id" => $category_id,
            "created_by" => 2,
            "updated_by" => 2,
        ];

        update('posts', $datas, $id, $conn);
        header("location:posts.php");

        // var_dump($datas);


    }else{
        include "nav.php";
    

?>
    <main class="my-5">
        <div class="container-fluid px-3 "> 
            <div class="card">
                <div class="card-header">
                    <p class="d-inline">Post Edit</p>
                    <a href="post.php" class="btn btn-sm btn-danger float-end">Cancel</a>
                </div>
                <div class="card-body">
                     <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" value="<?= $post['title'] ?>" name="title">
                        </div>
                        
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="old_photo-tab" data-bs-toggle="tab" data-bs-target="#old_photo-tab-pane" type="button" role="tab" aria-controls="old_photo-tab-pane" aria-selected="true">Old Photo</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="new_photo-tab" data-bs-toggle="tab" data-bs-target="#new_photo-tab-pane" type="button" role="tab" aria-controls="new_photo-tab-pane" aria-selected="false">New Photo</button>
                        </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="old_photo-tab-pane" role="tabpanel" aria-labelledby="old_photo-tab" tabindex="0">
                                <img src="<?= $post['image'] ?>" width="200" height="200" class="my-3" alt="">
                                <input type="hidden" name="old_photo" value="<?= $post['image'] ?>">
                            </div>
                            <div class="tab-pane fade" id="new_photo-tab-pane" role="tabpanel" aria-labelledby="new_photo-tab" tabindex="0">
                            <input class="form-control my-3" type="file" id="image" name="image" >
                            </div>
                        </div>



                        <div class="mb-3">
                        <label for="category_id">Category</label>
                        <select class="form-select mb-3" name="category_id" id="category_id">
                            <option selected>Select Category</option>
                            <?php
                                $categories =  select('categories', '*', null, null, 'id DESC', $conn);
                                foreach ($categories as $category){
                            ?>
                            <option value="<?php echo $category['id'] ?>" <?php if($post['category_id'] == $category['id']){echo 'selected';} ?>><?php echo $category['name'] ?></option>
                            <?php
                                }
                            ?>
                        </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                      
                    </form>
                    
                </div>
                
            </div>
        </div>
    </main>

<?php 
    include "footer.php";
        }
    }else{
        header("location:login.php");
    }
?>

    