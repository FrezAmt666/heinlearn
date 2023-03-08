<?php 
require "../dbconnect.php";
require "../QueryBuilder.php";

session_start();
if(isset($_SESSION['user_id'])){

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name = $_POST['name'];
    
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    // echo $title, $category_id, $description;
    // print_r($image_arr);

   

    $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password) ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name' , $name);
    $stmt->bindParam(':email' , $email);
    $stmt->bindParam(':password' , $password);
    $stmt->execute();
    header("location:users.php");

    



}else{
    include "nav.php";
?>

    <main class="my-5"> 
        <div class="container-fluid px-3 "> 
            <div class="card">
                <div class="card-header">
                    <p class="d-inline">User Create</p>
                    <a href="post.php" class="btn btn-sm btn-danger float-end">Cancel</a>
                </div>
                <div class="card-body">
                     <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="email"  class="form-label">email</label>
                            <input class="form-control" type="text" id="email" name="email" >
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">password</label>
                            <input class="form-control" type="password" id="password" name="password" >

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