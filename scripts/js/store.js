function backHome(){
    location.replace('../index.php');
}

function goStoreList(){
    location.replace('pageShowStore.php');
}

function backFirstSession(){
    location.replace('pageAdmin.php');
}

function findStoreByName() {
    let input = document.querySelector("input[id='searchBar']");
    let filter = input.value.toUpperCase();
    let table = document.getElementById("getStoreList");
    let tr = table.getElementsByTagName("tr");

    for (let i = 0; i < tr.length; i++) {
        let td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            let txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}


/*========== GET STORE =========*/
function showStores(){
    var storeList = document.querySelector("tbody[id='getStoreList']");
    const url = '../scripts/php/getStores.php';
    
    let header = {
        method: 'GET',
        contentType: 'json',
        mode: 'cors',
        cache: 'default',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
            }
    };

    fetch(url, header)
    .then(response => response.json())
    .then(function(data){

        if(data.status == 404){
            storeList.innerHTML += `
                <tr>
                    <td> Não há nenhuma loja registrada. </td>
                </tr>`;
        }else{
            for(let i = 0; i < data.store.length; i++){
                storeList.innerHTML +=  `<tr>
                    <td>${data.store[i].nome}</td>
                    <td>${data.store[i].razao_social}</td>
                    <td>${data.store[i].cnpj}</td>
                    <td>${data.store[i].cidade}</td>
                    <td>${data.store[i].estado}</td>
                    <td>
                        <a href="pageShowStoreUsers.php?nameStore=${data.store[i].nome}&idStore=${data.store[i].id}" class='btn btn-info'>
                            <i class='fas fa-user'></i>
                        </a>
                        <button class='btn btn-danger'  data-toggle='modal' data-target='#dStoreModal' onclick="sendDataToDelete(${data.store[i].id}, '${data.store[i].nome}')">
                            <i class='fa fa-trash' aria-hidden='true'></i>
                        </button>
                        <button class='btn btn-success' data-toggle='modal' data-target='#rStoreModal' onclick='updateStore(${data.store[i].id})'>
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                </tr>`;
            }
        }
    }).catch(error => {
        console.error(error)
    });
}

/*========== CREATE STORE =========*/
function addStores(){
    const url = '../scripts/php/registerStore.php';


    let dataJson = {
        idStoreInputJ: document.querySelector('input[id=idStoreInput]').value,
        nameStoreInputJ: document.querySelector('input[id=nameStoreInput]').value,
        socialReasonJ: document.querySelector('input[id=socialReasonInput]').value,
        cnpjJ: document.querySelector('input[id=cnpjInput]').value,
        cityStoreJ: document.querySelector('input[id=cityStoreInput]').value,
        stateStoreJ: document.querySelector('input[id=stateStoreInput]').value
    }

    let header = {
        method: 'POST',
        contentType: 'json',
        mode: 'cors',
        cache: 'default',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(dataJson)
    }

    var warningRegister = document.querySelector('label[id=rStoreWarning]');
    
    switch(true){
        case dataJson.nameStoreInputJ == '' || dataJson.nameStoreInputJ == null:
            warningRegister.innerHTML = 'Insira um nome para a sua loja.';
            $('#rStoreModal').on('hidden.bs.modal', function () {
                $(this).find('form').trigger('reset');
                warningRegister.innerHTML = '';
            });
        break;
        case dataJson.socialReasonJ == '' || dataJson.socialReasonJ == null:
            warningRegister.innerHTML = 'Insira uma razão social para a sua loja.';
            $('#rStoreModal').on('hidden.bs.modal', function () {
                $(this).find('form').trigger('reset');
                warningRegister.innerHTML = '';
            });
        break;
        case dataJson.cnpjJ == '' || dataJson.cnpjJ == null:
            warningRegister.innerHTML = 'Insira um CNPJ para a sua loja.';
            $('#rStoreModal').on('hidden.bs.modal', function () {
                $(this).find('form').trigger('reset');
                warningRegister.innerHTML = '';
            });
        break;
        case dataJson.cityStoreJ == '' || dataJson.cityStoreJ == null:
            warningRegister.innerHTML = 'Insira uma cidade para a sua loja.';
            $('#rStoreModal').on('hidden.bs.modal', function () {
                $(this).find('form').trigger('reset');
                warningRegister.innerHTML = '';
            });
        break;
        case dataJson.stateStoreJ == '' || dataJson.stateStoreJ == null:
            warningRegister.innerHTML = 'Insira um estado para a sua loja.';
            $('#rStoreModal').on('hidden.bs.modal', function () {
                $(this).find('form').trigger('reset');
                warningRegister.innerHTML = '';
            });
        break;
        default:
            fetch(url, header)
            .then(response => response.json())
            .then(function(data){

                switch(true){
                    case data.status == 200:
                        warningRegister.innerHTML = 'Loja cadastrada com sucesso!';
                    break;
                    case data.status == 201:
                        warningRegister.innerHTML = 'Loja alterada com sucesso!';
                    break;
                    case data.status == 500:
                        warningRegister.innerHTML = 'Houve um erro ao cadastrar a loja.';
                    case data.status == 501:
                        warningRegister.innerHTML = 'Houve um erro ao alterar a loja.';
                    break;
                    default:
                        warningRegister.innerHTML = 'Houve um erro inesperado, chame o desenvolvedor.';
                }
        
                setTimeout(() => {
                    location.reload();
                }, 1200);
            }).catch(error => {
                console.log(error);
            });
    }
}

/*========== DELETE STORE =========*/
function sendDataToDelete(id, storeName){
    document.getElementById('idStoreInputDelete').value = id;
    document.getElementById('dStoreMLabel').innerHTML = 'Tem certeza que deseja excluir a loja: '+storeName +'?';
}

function deleteStore(id){
    const url = '../scripts/php/deleteStore.php';

    let header = {
        method: 'POST',
        contentType: 'json',
        mode: 'cors',
        cache: 'default',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(id)
    }

    fetch(url, header)
    .then(response => response.json())
    .then(function(data){
        console.log(data);
        if(data.status == 200){
            document.querySelector('span[id=dStoreWarning]').innerHTML = 'Loja excluida com sucesso!';
            document.querySelector('div[id=dModalBody]').style.display = '';
            setTimeout(() => {
                location.reload();
            }, 1200);
        }else{
            document.querySelector('span[id=dStoreWarning]').innerHTML = 'Houve um problema ao excluir a loja.';
        }
        
    }).catch(error => {
        console.log(error);
    })
    
}

/*========== UPDATE STORE =========*/
function updateStore(id){
    const url = '../scripts/php/getStoreToUp.php';

    let header = {
        method: 'POST',
        contentType: 'json',
        mode: 'cors',
        cache: 'default',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(id)
    }

    fetch(url, header)
    .then(response => response.json())
    .then(function(data){
        document.querySelector('#rStoreMLabel').innerHTML = 'Alterar a loja: ' + data.upstore[0].nome;
        document.querySelector('input[id=idStoreInput]').value = data.upstore[0].id;
        document.querySelector('input[id=nameStoreInput]').value = data.upstore[0].nome;
        document.querySelector('input[id=socialReasonInput]').value = data.upstore[0].razao_social;
        document.querySelector('input[id=cityStoreInput]').value = data.upstore[0].cidade;
        document.querySelector('input[id=stateStoreInput]').value = data.upstore[0].estado;
        document.querySelector('input[id=cnpjInput]').value = data.upstore[0].cnpj;
        document.querySelector('input[id=cnpjInput]').style.display = 'none';
        document.querySelector('label[id=cnpjLabel]').style.display = 'none';
        document.getElementById('rStoreSubmit').value = 'Alterar'
        
        //Reset the all fields to default values
        $('#rStoreModal').on('hidden.bs.modal', function () {
            $(this).find('form').trigger('reset');
            document.getElementById('rStoreSubmit').value = 'Cadastrar';
            document.querySelector('label[id=rStoreMLabel]').innerHTML = 'Registrar nova loja';
            document.querySelector('input[id=cnpjInput]').style.display = '';
            document.querySelector('label[id=cnpjLabel]').style.display = '';
            document.querySelector('label[id=rStoreWarning]').innerHTML = '';
        });

    }).catch(error => {
        console.log(error);
    })
}