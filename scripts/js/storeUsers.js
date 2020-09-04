function backStores(){
    location.replace('pageShowStore.php');
}

function findUserByName() {
    let input = document.querySelector("input[id='searchBar']");
    let filter = input.value.toUpperCase();
    let table = document.getElementById("getUserList");
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

/*========== GET USER =========*/
function showUsers(){
    var userList = document.querySelector('tbody[id=getUserList]');
    const url = '../scripts/php/getUsers.php';

    dataJson = {
        idStoreInputJ: document.querySelector('input[id=idStoreInput]').value
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

    fetch(url, header)
    .then(response => response.json())
    .then(function(data){
        
        if(data.status == 404){
            userList.innerHTML += `
            <tr>
                <td> Esta loja não possui nenhum usuário. </td>
            </tr>`;
        }else{
            for(let i = 0; i < data.user.length; i++){
                userList.innerHTML += `
                    <td>${data.user[i].nick_name}</td>
                    <td>${data.user[i].role}</td>
                    <td>${data.user[i].data_nasc}</td>
                    <td>
                        <button class='btn btn-danger'  data-toggle='modal' data-target='#dUserModal' onclick="sendDataToDelete(${data.user[i].id}, '${data.user[i].nick_name}')">
                            <i class='fa fa-trash' aria-hidden='true'></i>
                        </button>
                        <button class='btn btn-success' data-toggle='modal' data-target='#rUserModal' onclick="updateUser(${data.user[i].id})">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>`;
            }
        }

    }).catch(error => {
        console.log(error);
    });
}

/*========== CREATE USER =========*/
function addUsers(){
    const url = '../scripts/php/registerUser.php';

    let dataJson = {
        idUserInputJ: document.querySelector('input[id=idUserInput]').value,
        idStoreInputJ: document.querySelector('input[id=idStoreInput]').value,
        nickNameJ: document.querySelector('input[id=nickNameInput]').value,
        roleInputJ: document.querySelector('select[id=roleSelect]').value,
        passwordInputJ: document.querySelector('input[id=passwordInput]').value,
        birthDateJ: document.querySelector('input[id=birthDateInput]').value,
    }

    let header = {
        method: 'POST',
        contentType: 'json',
        mode: 'cors',
        cache: 'default',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(dataJson)
    }

    var warningUpdate = document.querySelector('label[id=rUserWarning]');

    switch(true){
        case dataJson.nickNameJ == '' || dataJson.nickNameJ == null:
            warningUpdate.innerHTML = 'Insira um nome para o seu usuário.';
            $('#rUserModal').on('hidden.bs.modal', function () {
                $(this).find('form').trigger('reset');
                warningUpdate.innerHTML = '';
            });
        break;
        case dataJson.roleInputJ == '' || dataJson.roleInputJ == null:
            warningUpdate.innerHTML = 'Insira um cargo para o seu usuário.';
            $('#rUserModal').on('hidden.bs.modal', function () {
                $(this).find('form').trigger('reset');
                warningUpdate.innerHTML = '';
            });
        break;
        case dataJson.passwordInputJ == '' || dataJson.passwordInputJ == null:
            warningUpdate.innerHTML = 'Insira uma senha para o seu usuário.';
            $('#rUserModal').on('hidden.bs.modal', function () {
                $(this).find('form').trigger('reset');
                warningUpdate.innerHTML = '';
            });
        break;
        case dataJson.birthDateJ == '' || dataJson.birthDateJ == null:
            warningUpdate.innerHTML = 'Insira uma data de nascimento para o seu usuário.';
            $('#rUserModal').on('hidden.bs.modal', function () {
                $(this).find('form').trigger('reset');
                warningUpdate.innerHTML = '';
            });
        break;
        default:
            fetch(url, header)
            .then(response => response.json())
            .then(function(data){
                
                switch(true){
                    case data.status == 200:
                        warningUpdate.innerHTML = 'Usuário cadastrado com sucesso!';
                    break;
                    case data.status == 201:
                        warningUpdate.innerHTML = 'Usuário alterado com sucesso!';
                    break;
                    case data.status == 406:
                        warningUpdate.innerHTML = 'Já existe um usuário com este nome, tente usar outro.';
                    break;
                    case data.status == 500:
                        warningUpdate.innerHTML = 'Houve um erro ao cadastrar o usuário!';
                    case data.status == 501:
                        warningUpdate.innerHTML = 'Houve um erro ao alterar o usuário!';
                    break;
                    default:
                        warningUpdate.innerHTML = 'Houve um erro inesperado, chame o desenvolvedor.';
                }
        
                setTimeout(() => {
                    location.reload();
                }, 1200);
        
        
            }).catch(error =>{
                console.log(error);
            });
    }
}

function sendDataToDelete(id, userName){
    document.getElementById('idUserInputDelete').value = id;
    document.getElementById('dUserMLabel').innerHTML = 'Tem certeza que deseja excluir o usuário: '+userName +'?';
}

/*========== DELETE USER =========*/
function deleteUser(id){
    const url = '../scripts/php/deleteUser.php';


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
        if(data.status == 200){
            document.querySelector('span[id=dUserWarning]').innerHTML = 'Usuário excluido com sucesso!';
            document.querySelector('div[id=dUserBody]').style.display = '';
            setTimeout(() => {
                location.reload();
            }, 1200);
        }else{
            document.querySelector('span[id=dUserWarning]').innerHTML = 'Houve um problema ao excluir o usuário.';
        }

    }).catch(error => {
        console.log(error);
    });
}

/*========== UPDATE USER =========*/
function updateUser(id){
    const url = '../scripts/php/getUserToUp.php';

    let jsonData = {
        idUserJ: id,
    }

    let header = {
        method: 'POST',
        contentType: 'json',
        mode: 'cors',
        cache: 'default',
        headers:{
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(jsonData)
    }

    fetch(url, header)
    .then(response => response.json())
    .then(function(data){
        console.log(data);
        document.querySelector('label[id=rUserMLabel]').innerHTML = 'Alterar o usuário: '+data.upuser[0].nick_name; 
        document.querySelector('input[id=idUserInput]').value = data.upuser[0].id;
        document.querySelector('input[id=nickNameInput]').value = data.upuser[0].nick_name;
        document.querySelector('select[id=roleSelect]').value = data.upuser[0].role;
        document.querySelector('input[id=passwordInput]').value = data.upuser[0].password;
        document.querySelector('input[id=birthDateInput]').value = data.upuser[0].data_nasc;
        document.querySelector('input[id=rUserSubmit]').value = 'Alterar';

        //Reset the all fields to default values
        $('#rUserModal').on('hidden.bs.modal', function () {
            $(this).find('form').trigger('reset');
            document.getElementById('rUserSubmit').value = 'Cadastrar';
            document.querySelector('label[id=rUserMLabel]').innerHTML = 'Registrar um novo usuário';
            document.querySelector('label[id=rUserWarning]').innerHTML = '';

        });


    }).catch(error => {
        console.log(error);
    });
}