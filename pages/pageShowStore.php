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
        <title>Stores</title>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css'/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <link rel='stylesheet' href='../css/style.css'/>
        <script src='../scripts/js/store.js' defer></script>
    </head>
    <body onload='showStores()'>
<!--=========================== REGISTER MODAL ==================================-->
        <div class="modal fade" id="rStoreModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rStoreMLabel"> Registrar nova loja </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class='form-group'>
                        <input type='hidden' id='idStoreInput'/>
                        <label style='margin-top:15px' >Nome Loja:</label>
                        <input class='form-control' type='text' id='nameStoreInput'/>
                        <label style='margin-top:15px' >Razão Social:</label>
                        <input class='form-control' type='text' id='socialReasonInput' />
                        <label style='margin-top:15px' id='cnpjLabel'>CNPJ:</label>
                        <input class='form-control' type='text' id='cnpjInput' />
                        <label style='margin-top:15px' >Cidade:</label>
                        <input class='form-control' type='text' id='cityStoreInput'/>
                        <label style='margin-top:15px' >Estado:</label>
                        <input class='form-control' type='text' id='stateStoreInput'/>
                    </form>
                </div>
                <div class="modal-footer">
                    <span id='rStoreWarning'></span>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button id='rStoreSubmit' type="button" class="btn btn-primary" onclick='addStores()'>Cadastrar</button>
                </div>
                </div>
            </div>
        </div>
<!--=========================== END MODAL ==================================-->

        <nav class="navbar navbar-dark" style="background-color: #a3543d;">
            <a style="color: white; font-size: 17px; font-style:italic;">Bem vindo 
                <?php
                    echo $_SESSION['userAdm'];
                ?>
                !
            </a>
            <button class='btn-register' data-toggle='modal' data-target='#rStoreModal' style='margin-left: 81%;'>Registrar Loja</button>
            <button class='btn-register' style="margin-left: 92%; width: 72px;" onclick='backHome()'>Voltar</button>
        </nav>
        <div id="allStores" class='col-md-12'>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome Loja:</th>
                        <th>Razão Social:</th>
                        <th>CNPJ:</th>
                        <th>Cidade:</th>
                        <th>Estado:</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id='getStoreList'>
                    <div style='display: none;'>
                    </div>
                </tbody>
            </table>
        </div>

    </body>
</html>