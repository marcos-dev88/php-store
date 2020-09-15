<?php
    include 'scripts/php/login.php';
?>

<html>
    <head>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css'/>
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
                <input class="input-style-default" id='iPasswordInput' type="password" name="password" placeholder="Senha"/>
                <label id='showPassIcon' class='fas fa-eye show-pass-input-index' style='color: #5f5d5e;'>
                    <input type='checkbox' style='opacity: 0' checked='checked' onclick='showPassword()' id='changeInputB'/>
                </label>
                <p></p>
                <input class="btn-php-store" style="margin-left: -6%; margin-top: 1.5%;" type="submit" name="btnLogin" value="Entrar"/>
            </form>
            <?php 
                echo $error_login;
            ?>
        </div>
    </body>

    <script>
        function showPassword(){
            let checkbox = document.querySelector('input[id=changeInputB]');
            if(checkbox.checked){
                document.querySelector('input[id=iPasswordInput').type = 'text';
                document.querySelector('label[id=showPassIcon]').className = 'fas fa-eye-slash show-pass-input-index';
            }else{
                document.querySelector('input[id=iPasswordInput').type = 'password';
                document.querySelector('label[id=showPassIcon]').className = 'fas fa-eye show-pass-input-index';
            }
        }
    </script>

</html>