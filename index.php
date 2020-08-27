<?php
    include 'scripts/php/login.php';
?>

<html>
    <head>
        <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
        <meta content="utf-8" http-equiv="encoding">
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
        <title>Página inicial</title>
    </head>
    <body style="background-color: #DEDDD3">
        <div class="form-div-index">
            <form action="scripts/php/login.php" method="POST">
                <input class="first-input-style" type="text" name="nickname" placeholder="Usuário"/>
                <p></p>
                <input class="input-style-default" type="text" name="password" placeholder="Senha"/>
                <p></p>
                <input class="btn-register" style="margin-left: -6%; margin-top: 1.5%;" type="submit" name="btnLogin" value="Entrar"/>
            </form>
            <?php 
                echo $error_login;
            ?>
        </div>
    </body>

</html>