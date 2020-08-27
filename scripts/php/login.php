<?php

    session_start();
    require_once('connection.php');

    $error_login = "";
    if(isset($_POST["btnLogin"])){
        $username = $_POST["nickname"];
        $pass = $_POST["password"];

        $user_query = "SELECT * FROM usuario WHERE nick_name = '$username' AND password = '$pass'";
        $conn_userq = mysqli_query($conn, $user_query);

        if(mysqli_num_rows($conn_userq) > 0){
            while($row = mysqli_fetch_assoc($conn_userq)){
               switch($row["role"]){
                    case "admin":
                        $_SESSION['userAdm'] = $row['nick_name'];
                        $_SESSION['roles'] = $row['role'];
                        header('Location: ../../pages/pageAdmin.php');
                    break;
                    case "user":
                        $_SESSION['user'] = $row['nick_name'];
                        $_SESSION['roles'] = $row['role'];
                        header('Location: ../../pages/pageUser.php');          
                    break;
                    default:
                        echo "Temos um erro por aqui... humm..."; 
               }
            }
        }else{
            $error_login = "Invalid username or password";
            header('Location: ../../index.php');
        }
    }

?>