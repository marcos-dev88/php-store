function backHome(){
    location.replace('../index.php');
}

function goStoreList(){
    location.replace('pageShowStore.php');
}

function getStoreByUser(){
    const url = '../scripts/php/getStorebyUser.php';
    let jsonData = {
        nameUserJ: document.querySelector('input[id=userNameInput]').value
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
        body: JSON.stringify(jsonData)    
    };

    console.log(jsonData);

    fetch(url, header)
    .then(response => response.json())
    .then(function(data){

        console.log(data);
        if(data.teamMate[0].count_user-1 > 0 && data.teamMate[0].count_user-1 != 1){
            document.getElementById('infoUser').innerHTML += `
                <li> Você faz parte da loja: ${data.sName[0].nome};</li>
                <li> Você possui o cargo de: ${verifyRole(data.roleUser)}; </li>
                <li> Você possui ${data.teamMate[0].count_user-1} colegas de trabalho.</li>
            `;
        }else if(data.teamMate[0].count_user-1 == 1 ){
            document.getElementById('infoUser').innerHTML += `
                <li> Você faz parte da loja: ${data.sName[0].nome};</li>
                <li> Você possui o cargo de: ${verifyRole(data.roleUser)}; </li>
                <li> Você possui ${data.teamMate[0].count_user-1} colega de trabalho.</li>
            `;
        }else{
            document.getElementById('infoUser').innerHTML += `
                <li> Você faz parte da loja: ${data.sName[0].nome};</li>
                <li> Você possui o cargo de: ${verifyRole(data.roleUser)}; </li>
                <li> Você não possui nenhum colega de trabalho.</li>
            `;
        }

        timeOfDay();
    }).catch(error => {
        console.log(error);
        timeOfDay();
    });
}

/* ========== UPDATE PASSWORD ========= */
function changeUserPass(){
    const url = '../scripts/php/changePass.php';

    let jsonData = {
        userNameJ: document.querySelector('input[id=userNameInput]').value,
        passwordJ: document.querySelector('input[id=passwordInput]').value,
        repeatPasswordJ: document.querySelector('input[id=repeatPasswordInput]').value
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
        body: JSON.stringify(jsonData) 
    }

    fetch(url, header)
    .then(response => response.json())
    .then(function(data){
        
        let warning = document.querySelector('label[id=changePassWarning]');

        if(data.status == 406){
            warning.innerHTML = 'Senhas não coincidem, tente novamente.';
        }else if(data.status == 200){
            warning.innerHTML = 'Senha alterada com sucesso!';
            setTimeout(() => {
                location.reload();
            }, 1200);
        }else{
            warning.innerHTML = 'Houve algum problema, chame o desenvolvedor.';
        }
    
    }).catch(error => {
        console.log(error);
    });
}

function cleanFields(){
    $('#rStoreModal').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
        document.querySelector('label[id=rStoreWarning]').innerHTML = '';
    });
}

function timeOfDay(){
    date = new Date();
    let greeting = document.querySelector('#greetingMessage');
    console.log(greeting);
    time = date.getHours();

    switch(true){
        case time >= 0 && time < 12:
            greeting.innerHTML = "Bom dia";
        break;
        case time >= 12 && time < 18:
            greeting.innerHTML = "Boa tarde";
        break;
        case time >= 18 && time < 24:
            greeting.innerHTML = "Boa noite";
        break;
    }
}

function verifyRole(role){
    switch(role){
        case "user":
            return 'Usuário';
        case "admin":
            return 'Administrador';
    }
}
