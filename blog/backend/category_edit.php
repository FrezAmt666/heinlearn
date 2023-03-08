<?php 
 session_start();
 if(isset($_SESSION['user_id'])){
    require "../dbconnect.php";
    require "../QueryBuilder.php";

    $id = $_GET['id'];

   
    $category = edit('categories', $id, $conn);
    // echo "<pre>";
    // print_r($category);
    // echo "</pre>";



    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $name = $_POST['name'];
        

        echo "$name<br>";
        
        $created_by = 2;
        $updated_by = 2;

        
        $datas = [
            "name" =>  $name,
            "created_by" => 2,
            "updated_by" => 2,
        ];

        update('categories',$datas, $id, $conn);
        header("location: categories.php");

        // var_dump($datas);


    }else{
        include "nav.php";
    

?>
    <main class="my-5">
        <div class="container-fluid px-3 "> 
            <div class="card">
                <div class="card-header">
                    <p class="d-inline">Category Edit</p>
                    <a href="post.php" class="btn btn-sm btn-danger float-end">Cancel</a>
                </div>
                <div class="card-body">
                     <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= $category['name'] ?>" >
                        </div>

                        <div class="mb-3">
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

    