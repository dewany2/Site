
<?php

include "config.php";
session_start();

if(isset($_SESSION["username"])){
    header("Location:{$hostname}/admin/post.php");
}

?>

<!doctype html>
<html lang="pt-br">
   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Empresa | Login</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <div id="wrapper-admin" class="body-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-4 col-md-4">
                        <img class="logo" src="images/news.jpg">
                        <h3 class="heading">Corporação</h3>
                        <!-- Form Start -->
                        <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                            <div class="form-group">
                                <label>Usuário</label>
                                <input type="text" name="username" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Senha</label>
                                <input type="password" name="password" class="form-control" placeholder="" required>
                            </div>
                            <input type="submit" name="login" class="btn btn-primary" value="login" />
                        </form>
                        <!-- /Form  End -->
                        <?php
                        
                            if(isset($_POST['login'])){
                                include "config.php";
                                if(empty($_POST['username']) || empty($_POST['password'])){
                                    echo "<div class='alert alert-danger' >Username and Password must be entered.</div>";
                                    die();
                                }else{
                                    $username = mysqli_real_escape_string($conn,$_POST['username']);
                                $password = mysqli_real_escape_string($conn, ( $_POST['password']));

                                $sql =  "SELECT user_id, username,first_name ,last_name, role FROM user WHERE username = '{$username}' AND password = '{$password}'";
                                $ressult = mysqli_query($conn,$sql) or die("Query Failed");
                                if(mysqli_num_rows($ressult)>0){
                                    while($row = mysqli_fetch_assoc($ressult)){
                                        session_start();
                                        $_SESSION["username"] = $row["username"];
                                        $_SESSION["user_id"] = $row["user_id"];
                                        $_SESSION["first_name"] = $row["first_name"];
                                        $_SESSION["last_name"] = $row["last_name"];
                                        $_SESSION["user_role"] = $row["role"];

                                        header("Location:{$hostname}/admin/post.php");
                                    }            
                                }else{
                                    echo "<div class='alert alert-danger' >Usuário Inválido</div>";
                                }                
                                }
                                
                            }

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
