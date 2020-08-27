<?php
    session_start();
    
    if(isset($_SESSION['roles'])){
        if($_SESSION['roles'] != 'user'){
            header('Location: ../index.php');
        }
    }
?>

<html>
    <head>
        <meta charset='utf-8'/>
        <title>Pagina de usuário</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <link rel='stylesheet' href='../css/style.css'/>
        <script src='../scripts/js/user.js' defer></script>
    </head>
    
    <body>
        <nav class="navbar navbar-dark" style="background-color: #a3543d;">
            <a style="color: white; font-size: 17px; font-style:italic;">Bem vindo 
                <?php
                    echo $_SESSION['user'];
                ?>
                !
            </a>
            <button class='btn-register' style="margin-left: 92%; width: 72px;" onclick='backHome()'>Sair</button>
        </nav>
    </body>

</html>