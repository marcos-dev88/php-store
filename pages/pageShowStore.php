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
        <title>Lojas</title>
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
            <div class="modal-content" style='background-color: #333231; color: white;'>
            <div class="modal-header">
                <label class="modal-title" id="rStoreMLabel"> Registrar nova loja </label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style='color: white'>
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class='form-group'>
                    <input type='hidden' id='idStoreInput'/>
                    <label style='margin-top:15px' >Nome Loja <span class='required'>*</span>:</label>
                    <input class='form-control' type='text' id='nameStoreInput'/>
                    <label style='margin-top:15px' >Razão Social <span class='required'>*</span>:</label>
                    <input class='form-control' type='text' id='socialReasonInput' />
                    <label style='margin-top:15px' id='cnpjLabel'>CNPJ <span class='required'>*</span>:</label>
                    <input class='form-control' type='text' id='cnpjInput'/>
                    <label style='margin-top:15px' >Cidade <span class='required'>*</span>:</label>
                    <input class='form-control' type='text' id='cityStoreInput'/>
                    <label style='margin-top:15px' >Estado <span class='required'>*</span>:</label>
                    <input class='form-control' type='text' id='stateStoreInput'/>
                </form>
                <label id='rStoreWarning' style='margin-top: 10px;'></label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick='cleanFields()'>Cancelar</button>
                <input id='rStoreSubmit' type="button" class="btn btn-primary" onclick='addStores()' value='Cadastrar'/>
            </div>
            </div>
        </div>
    </div>

<!--=========================== DELETE MODAL ==================================-->
    <div class="modal fade" id="dStoreModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style='background-color: #333231; color: white;'>
            <div class="modal-header">
                <label class="modal-title" id="dStoreMLabel"></label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style='color: white'>
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id='dModalBody' class='modal-body' style='display: none'>
                <span id='dStoreWarning'></span>
            </div>
            <div class="modal-footer">
            <input type='hidden' id='idStoreInputDelete'/>
                
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <input id='dStoreSubmit' type="button" class="btn btn-danger" onclick="deleteStore(document.querySelector('input[id=idStoreInputDelete]').value)" value='Excluir'/>
            </div>
            </div>
        </div>
    </div>

<!--=========================== END MODAL ==================================-->

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
            <button class='btn-php-store' style="margin-left: 92%; width: 72px;" onclick='backFirstSession()'>Voltar</button>
        </nav>
        <div class='col-md-12 form-group m-t-lg'>
            <div class='div-search-icon'>
                <i style='color: #fff; font-size: 22px' class="fas fa-search"></i>
            </div>
            <input class='form-control input-search-store' id='searchBar' type='text' onkeyup='findStoreByName()' placeholder='Pesquise pelo nome da loja: '/>
        </div>
        <button class='btn-add-php-store' data-toggle='modal' data-target='#rStoreModal' style='margin-left: 95%;'>
            <i class="fas fa-plus"></i>
        </button>
        <div id="allStores" class='col-md-12 div-present-stores' style='background-color: #333231;'>
            <table class="table" style='color: #fff;'>
                <thead>
                    <tr>
                        <th style='border-top: none !important;'>Nome Loja:</th>
                        <th style='border-top: none !important;'>Razão Social:</th>
                        <th style='border-top: none !important;'>CNPJ:</th>
                        <th style='border-top: none !important;'>Cidade:</th>
                        <th style='border-top: none !important;'>Estado:</th>
                        <th style='border-top: none !important;'></th>
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