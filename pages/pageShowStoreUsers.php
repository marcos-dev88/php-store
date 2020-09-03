<?php
    session_start();
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
        <title>Usuários</title>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css'/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <link rel='stylesheet' href='../css/style.css'/>
        <script src='../scripts/js/storeUsers.js' defer></script>
    </head>
    <input id='idStoreInput' type='hidden' value="<?php echo $_GET['idStore'] ?>"/>
    <body onload='showUsers()'>

<!--=========================== REGISTER MODAL ==================================-->
        <div class="modal fade" id="rUserModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <label class="modal-title" id="rUserMLabel"> Registrar novo Usuário </label>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class='form-group'>
                            <input type='hidden' id='idUserInput'/>
                            <label style='margin-top:15px' >*Nome de Usuário:</label>
                            <input class='form-control' type='text' id='nickNameInput'/>
                            <label style='margin-top:15px' >*Cargo:</label>
                            <select class="form-control" id='roleSelect'>
                                <option value='admin'>Administrador</option>
                                <option value='user'>Usuário</option>
                            </select>
                            <label style='margin-top:15px' id='passULabel'>*Senha:</label>
                            <input class='form-control' type='password' id='passwordInput' />
                            <label style='margin-top:15px' >*Data de Nascimento:</label>
                            <input class='form-control' type='text' id='birthDateInput'/>
                        </form>
                        <label id='rUserWarning' style='margin-top: 10px;'></label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <input id='rUserSubmit' type="button" class="btn btn-primary" onclick='addUsers()' value='Cadastrar'/>
                    </div>
                </div>
            </div>
        </div>    

<!--=========================== DELETE MODAL ==================================-->

<div class="modal fade" id="dUserModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <label class="modal-title" id="dUserMLabel"></label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id='dUserBody' class='modal-body' style='display: none'>
                <span id='dUserWarning'></span>
            </div>
            <div class="modal-footer">
            <input type='hidden' id='idUserInputDelete'/>
                
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <input id='dUserSubmit' type="button" class="btn btn-danger" onclick="deleteUser(document.querySelector('input[id=idUserInputDelete]').value)" value='Excluir'/>
            </div>
            </div>
        </div>
    </div>

<!--=========================== END MODAL ==================================-->

        <nav class="navbar navbar-dark" style="background-color: #333231;">
            <a style="color: white; font-size: 17px; font-style:italic;">Usuários da loja 
                <?php
                    echo $_GET['nameStore'];
                ?>
                :
            </a>
            <button class='btn-php-store' data-toggle='modal' data-target='#rUserModal' style='margin-left: 79%;'>Registrar Usuário</button>
            <button class='btn-php-store' style="margin-left: 92%; width: 72px;" onclick='backStores()'>Voltar</button>
        </nav>

        <div class='col-md-12 form-group m-t-lg'>
            <div class='div-search-icon'>
                <i style='color: #fff; font-size: 22px' class="fas fa-search"></i>
            </div>
            <input class='form-control input-search-store' id='searchBar' type='text' onkeyup='findUserByName()' placeholder='Pesquise pelo nome do usuário: '/>
        </div>
        <div id="allUsers" class='col-md-12 div-present-stores' style='background-color: #333231;'>
            <table class="table" style='color: #fff;'>
                <thead>
                    <tr>
                        <th style='border-top: none !important;'>Nome Usuário:</th>
                        <th style='border-top: none !important;'>Cargo:</th>
                        <th style='border-top: none !important;'>Data de Nascimento:</th>
                        <th style='border-top: none !important;'></th>
                    </tr>
                </thead>
                <tbody id='getUserList'>
                    <div style='display: none;'>
                    </div>
                </tbody>
            </table>
        </div>

    </body>
</html>