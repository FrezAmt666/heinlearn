<?php 
    session_start();

    if(isset($_SESSION['user_id'])){
        header('location:index.php');
    }else{

    require "../dbconnect.php";
    require "../QueryBuilder.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $email = $_POST['email'];
        // $password = sha1($_POST['password']);
        $password = $_POST['password'];

        // echo"$email" and "$password";

        if($user = login('users', $email, $password, $conn)){
            // var_dump($user);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['password'] = $user['password'];
            $_SESSION['role'] = $user['role'];

            if(isset($_SESSION["user_id"])){
                header("location:index.php");
            }
            
        }else{
            echo "Invalid Email or Password";

        }

    }else{

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="email" id="inputEmail" type="email" placeholder="name@example.com" />
                                                <label for="inputEmail">Email address</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="password" id="inputPassword" type="password" placeholder="Password" />
                                                <label for="inputPassword">Password</label>
                                            </div>

                                            <div class="text-end mt-4 mb-0">
                                                <button class="btn btn-primary" type="submit">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>

<?php 
    }
}
?>
