function backHome(){
    location.replace('../index.php');
}

function goStoreList(){
    location.replace('pageShowStore.php');
}
/*========== GET STORE =========*/
function showStores(){
    var storeList = document.querySelector("tbody[id='getStoreList']");
    let url = '../scripts/php/getStores.php';
    
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

        for(let i = 0; i < data.store.length; i++){
            storeList.innerHTML +=  `<tr>
                <td>${data.store[i].nome}</td>
                <td>${data.store[i].razao_social}</td>
                <td>${data.store[i].cnpj}</td>
                <td>${data.store[i].cidade}</td>
                <td>${data.store[i].estado}</td>
                <td>
                    <button class='btn btn-danger' onclick='deleteStore(${data.store[i].id})'>
                        <i class='fa fa-trash' aria-hidden='true'></i>
                    </button>
                    <button class='btn btn-success' data-toggle='modal' data-target='#rStoreModal' onclick='updateStore(${data.store[i].id})'>
                        <i class="fas fa-edit"></i>
                    </button>
                </td>
            </tr>`;
        }
    }).catch(error => {
        console.error(error)
    });
}

/*========== CREATE STORE =========*/
function addStores(){
    let url = '../scripts/php/registerStore.php';


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

    var warningRegister = document.querySelector('span[id=rStoreWarning]');
    
    switch(true){
        case dataJson.nameStoreInputJ == '' || dataJson.nameStoreInputJ == null:
            warningRegister.innerHTML = 'Insira um nome para a sua loja.';
        break;
        case dataJson.socialReasonJ == '' || dataJson.socialReasonJ == null:
            warningRegister.innerHTML = 'Insira uma razão social para a sua loja.';
        break;
        case dataJson.cnpjJ == '' || dataJson.cnpjJ == null:
            warningRegister.innerHTML = 'Insira um CNPJ para a sua loja.';
        break;
        case dataJson.cityStoreJ == '' || dataJson.cityStoreJ == null:
            warningRegister.innerHTML = 'Insira uma cidade para a sua loja.';
        break;
        case dataJson.stateStoreJ == '' || dataJson.stateStoreJ == null:
            warningRegister.innerHTML = 'Insira um estado para a sua loja.';
        break;
        default:
            fetch(url, header)
            .then(response => response.text())
            .then(function(){
                
                warningRegister.innerHTML = 'Loja Cadastrada com sucesso!';
            }).catch(error => {
                console.log(error);
            });
    }
}

/*========== DELETE STORE =========*/
function deleteStore(id){
    let url = '../scripts/php/deleteStore.php';

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

    if(confirm('Deseja realmente deletar esta loja?')){
        fetch(url, header)
        .then(response => response.text())
        .then(function(data){
            console.log(data);
            
        }).catch(error => {
            console.log(error);
        })
    }
}

/*========== UPDATE STORE =========*/
function updateStore(id){
    let url = '../scripts/php/getStoreToUp.php';

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
    .then(response => response.text())
    .then(function(data){
        console.log(data);
        let parseData = JSON.parse(data);
        document.querySelector('#rStoreMLabel').innerHTML = 'Alterar loja ' + parseData.upstore[0].nome;
        document.querySelector('input[id=idStoreInput]').value = parseData.upstore[0].id;
        document.querySelector('input[id=nameStoreInput]').value = parseData.upstore[0].nome;
        document.querySelector('input[id=socialReasonInput]').value = parseData.upstore[0].razao_social;
        document.querySelector('input[id=cityStoreInput]').value = parseData.upstore[0].cidade;
        document.querySelector('input[id=stateStoreInput]').value = parseData.upstore[0].estado;
        document.querySelector('input[id=cnpjInput]').value = parseData.upstore[0].cnpj;
        document.querySelector('input[id=cnpjInput]').style.display = 'none';
        document.querySelector('label[id=cnpjLabel]').style.display = 'none';
        document.querySelector('button[id=rStoreSubmit]').value = 'Alterar'
        
        //Reset the all fields to default values
        $('#rStoreModal').on('hidden.bs.modal', function () {
            $(this).find('form').trigger('reset');
            document.querySelector('button[id=rStoreSubmit]').value = 'Cadastrar';
            document.querySelector('h5[id=rStoreMLabel]').value = 'Registrar nova loja';
            document.querySelector('input[id=cnpjInput]').style.display = '';
            document.querySelector('label[id=cnpjLabel]').style.display = '';
        });

    }).catch(error => {
        console.log(error);
    })
}