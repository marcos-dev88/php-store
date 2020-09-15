<?php
    session_start();
    //Verifica se você é a admin mesmo
    if(isset($_SESSION['roles'])){
        if($_SESSION['roles'] != 'admin'){
            header('Location: pageUser.php');
        }
    }else{
        header('Location: ../index.php');
    }
?>

<html>
    <head>
        <meta charset="utf-8"/>
        <title>Página de Admin</title>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css'/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <link rel='stylesheet' href='../css/style.css'/>
        <script src='../scripts/js/admin.js' defer></script>
    </head>

    <body onload='getStoreByUser()'>
<!--=========================== CHANGE PASSWORD MODAL ==================================-->
    <div class="modal fade" id="changePasswordM" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style='background-color: #333231; color: white;'>
                <div class="modal-header">
                    <label class="modal-title"> Alterar a senha</label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style='color: white'>
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class='form-group'>
                        <label style='margin-top:15px'>Nova senha <span class='required'>*</span>:</label>
                        <input class='form-control' type='password' id='passwordInput'/>
                        <label id='showPassIcon' class='fas fa-eye show-pass-input' style='color: #5f5d5e;'>
                            <input type='checkbox' style='opacity: 0' checked='checked' onclick='showPassword()' id='changeInputB'/>
                        </label>
                        <label style='margin-top:15px'>Repetir nova senha <span class='required'>*</span>:</label>
                        <input class='form-control' type='password' id='repeatPasswordInput'/>
                    </form>
                    <label id='changePassWarning' style='margin-top: 10px;'></label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick='cleanFields()'>Cancelar</button>
                    <input id='changePasswordM' type="button" class="btn btn-primary" onclick='changeUserPass()' value='Alterar'/>
                </div>
                </div>
            </div>
        </div>
<!--=========================== END MODAL ==================================-->

    <input id='userNameInput' type='hidden' value="<?php echo $_SESSION['userAdm'] ?>"/>
        <nav class="navbar navbar-dark" style="background-color: #333231;">
            <label style="color: white; font-size: 17px; font-style:italic;">
                    <span id='greetingMessage'></span>
                    <span>
                        <?php
                            echo $_SESSION['userAdm'];
                        ?>
                        !
                    </span>
            </label>
            <button class='btn-php-store' data-toggle='modal' data-target='#changePasswordM' style='margin-left: 65.5%;'>Alterar Senha</button>
            <button class='btn-php-store' style='margin-left: 78.8%;' onclick='goStoreList()'>Lojas Registradas</button>
            <button class='btn-php-store' style="margin-left: 92%; width: 72px;" onclick='backHome()'>Sair</button>
        </nav>

        <div class='div-information-user'>
            <ul id='infoUser' style='list-style-type: none;'>
            </ul>
        </div>

        <script>
            function showPassword(){
                let checkbox = document.querySelector('input[id=changeInputB]');
                if(checkbox.checked){
                    document.querySelector('input[id=passwordInput').type = 'text';
                    document.querySelector('label[id=showPassIcon]').className = 'fas fa-eye-slash show-pass-input';
                }else{
                    document.querySelector('input[id=passwordInput').type = 'password';
                    document.querySelector('label[id=showPassIcon]').className = 'fas fa-eye show-pass-input';
                }
            }
        </script>
    </body>
</html>