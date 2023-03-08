<?php 

session_start();
if(isset($_SESSION['user_id'])){
    require "../dbconnect.php";
    require "../QueryBuilder.php";

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $title = $_POST['title'];
        $image_arr = $_FILES['image'];
        $category_id = $_POST['category_id'];
        $description = $_POST['description'];
        // echo $title, $category_id, $description;
        // print_r($image_arr);
    
        if(isset($image_arr) && $image_arr['size']>0){
            $dir = "images/";
            $image = $dir.$image_arr['name'];
            $tmp_name = $image_arr['tmp_name'];
            move_uploaded_file($tmp_name, $image);
        }
    
        $post_date = date("Y-m-d");
        $created_by = 2;
        $updated_by = 2;

        // $sql = "INSERT INTO posts (title, image, description,  post_date, category_id, created_by, updated_by) VALUES (:title,  :image, :description, :post_date, :category_id,  :created_by, :updated_by) ";
        // $stmt = $conn->prepare($sql);
        // $stmt->bindParam(':title' , $title);
        // $stmt->bindParam(':image' , $image);
        // $stmt->bindParam(':description' , $description);
        // $stmt->bindParam(':post_date' , $post_date);
        // $stmt->bindParam(':category_id' , $category_id);
        // $stmt->bindParam(':created_by' , $created_by);
        // $stmt->bindParam(':updated_by' , $updated_by);
        // $stmt->execute();
        // header("location:posts.php");

        
        $datas = [
            "title" =>  $title,
            "image" => $image,
            "description" => $description,
            "post_date"=> $post_date,
            "category_id" => $category_id,
            "created_by" => 2,
            "updated_by" => 2,
        ];
        store('posts', $datas, $conn);
        header("location:posts.php");

        // var_dump($datas);


    }else{
        include "nav.php";
    

?>
    <main class="my-5">
        <div class="container-fluid px-3 "> 
            <div class="card">
                <div class="card-header">
                    <p class="d-inline">Post Create</p>
                    <a href="post.php" class="btn btn-sm btn-danger float-end">Cancel</a>
                </div>
                <div class="card-body">
                     <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="mb-3">
                            <label for="image"  class="form-label">Image</label>
                            <input class="form-control" type="file" id="image" name="image" >
                        </div>
                        <div class="mb-3">
                        <label for="category_id">Category</label>
                        <select class="form-select mb-3" name="category_id" id="category_id">
                            <option selected>Select Category</option>
                            <?php
                                $categories =  select('categories', '*',null , null, null, $conn);
                                foreach ($categories as $category){
                            ?>
                            <option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
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
    }
    else{
        header("location:login.php");
    }
?>

    