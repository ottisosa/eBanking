const accountsSelectList = document.querySelector("#from_account_id");
const formNewTransfer = document.querySelector("#newTransfer");
const accountToTransferInput = document.querySelector("#to_account_id");
const accountClientNameInput = document.querySelector("#nombre-destinatario");

newTransfer();
getAccounts();

accountToTransferInput.addEventListener("keyup", function() {
    verifyAccount();
})

function newTransfer() {

    formNewTransfer.onsubmit = async (e) => {
        e.preventDefault();

        let transferData = new FormData(formNewTransfer);

        let url = 'http://localhost/eBanking/app/controllers/TransactionController.php?function=register';

        let config = {
            method: 'POST',
            body: transferData
        };

        let response = await fetch(url, config);

        const result = await response.json();

        if(result.success){
            alert(result.message);
        } else {
            alert(result.error)
        }
    }

}

async function getAccounts() {

    let url = 'http://localhost/eBanking/app/controllers/AccountController.php?function=getAccounts';

    let response = await fetch(url);

    const result = await response.json();

    const accountList = result.data;

    accountList.forEach(account => {
        // Crear una nueva opción
        var accountOption = document.createElement('option');
        accountOption.value = account.account_id; // Valor que se enviará cuando se seleccione esta opción
        accountOption.textContent = `${account.account_id} -  $ ${account.balance}`; // Texto que se mostrará en el menú desplegable

        // Agregar la nueva opción al elemento <select>
        accountsSelectList.appendChild(accountOption);
    });

}


async function verifyAccount(){
    let url = 'http://localhost/eBanking/app/controllers/AccountController.php?function=verifyAccount';

    let formTransferData = new FormData();
    formTransferData.append("account_id", accountToTransferInput.value)

    let config = {
        method: 'POST',
        body: formTransferData
    };
    
    let response = await fetch(url, config);

    const result = await response.json();

    const data = result.data;

    if(data != null){
        accountClientNameInput.value = data.full_name;
    }



}