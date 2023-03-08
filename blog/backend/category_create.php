<?php 
 session_start();
 if(isset($_SESSION['user_id'])){
require "../dbconnect.php";
require "../QueryBuilder.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name = $_POST['name'];
    

    

   
    $created_by = 2;
    $updated_by = 2;

    $sql = "INSERT INTO categories (name, created_by, updated_by) VALUES (:name, :created_by, :updated_by) ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name' , $name);
    $stmt->bindParam(':created_by' , $created_by);
    $stmt->bindParam(':updated_by' , $updated_by);
    $stmt->execute();
    header("location:categories.php");

    
    


}else{
    include "nav.php";
   
?>

    <main class="my-5">
        <div class="container-fluid "> 
            
            <div class="card m-auto">
                <div class="card-header">
                    <p class="d-inline">Category Create</p>
                    <a href="categories.php" class="btn btn-sm btn-danger float-end">Cancel</a>
                </div>
                <div class="card-body">
                     <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
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