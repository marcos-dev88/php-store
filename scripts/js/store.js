function backHome(){
    location.replace('../index.php');
}

function goStoreList(){
    location.replace('pageShowStore.php');
}

function showStores(){
    var storeList = document.querySelector("tbody[id='getStoreList']");
    var url = '../scripts/php/getStores.php';
    fetch(url)
    .then(response => response.json())
    .then(function(data){
        console.log(data);
        for(var i = 0; i < data.store.length; i++){
            storeList.innerHTML +=  `<tr>
                <td>${data.store[i].nome}</td>
                <td>${data.store[i].razao_social}</td>
                <td>${data.store[i].cnpj}</td>
                <td>${data.store[i].cidade}</td>
                <td>${data.store[i].estado}</td>
            </tr>`;
        }
    }).catch(error => {
        console.error(error)
    });
}
