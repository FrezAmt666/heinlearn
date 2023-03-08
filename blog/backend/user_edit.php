<?php 
 session_start();
 if(isset($_SESSION['user_id'])){
    require "../dbconnect.php";
    require "../QueryBuilder.php";

    $id = $_GET['id'];

   
    $user = edit('users', $id, $conn);



    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
       
        
        $datas = [
            "name" =>  $name,
            "email" => $email,
            "password" => $password,
        ];

        update('users', $datas, $id, $conn);
        header("location:users.php");

        // var_dump($datas);


    }else{
        include "nav.php";
    

?>
    <main class="my-5">
        <div class="container-fluid px-3 "> 
            <div class="card">
                <div class="card-header">
                    <p class="d-inline">User Edit</p>
                    <a href="post.php" class="btn btn-sm btn-danger float-end">Cancel</a>
                </div>
                <div class="card-body">
                     <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" value="<?= $user['name'] ?>" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" value="<?= $user['email'] ?>" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="text" class="form-control" id="password" value="<?= $user['password'] ?>" name="password">
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

    