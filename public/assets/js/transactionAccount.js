const accountListSelect = document.querySelector("#cuenta-seleccionada");
const transactionListTable = document.querySelector("#listado-transacciones-table");

getAccounts();

accountListSelect.onchange = () => {
    getTransactionsById();
};


async function getAccounts() {

    let url = 'http://localhost/eBanking/app/controllers/AccountController.php?function=getAccounts';

    let response = await fetch(url);

    const result = await response.json();

    const accountList = result.data;

    accountList.forEach(account => {
        // Crear una nueva opción
        let accountOption = document.createElement('option');
        accountOption.value = account.account_id; // Valor que se enviará cuando se seleccione esta opción
        accountOption.textContent = `${account.account_id} -  $ ${account.balance}`; // Texto que se mostrará en el menú desplegable

        // Agregar la nueva opción al elemento <select>
        accountListSelect.appendChild(accountOption);
    });

}



async function getTransactionsById(){

let formDataTransaction = new FormData();
formDataTransaction.append('account_id', accountListSelect.value);
let url = 'http://localhost/eBanking/app/controllers/TransactionController.php?function=getTransactionsById';

let config = {
    method: 'POST',
    body: formDataTransaction
};

let response = await fetch(url, config);
const result = await response.json();
const transactionList = result.data;
transactionListTable.innerHTML = "";

transactionList.forEach(transaction => {

    transactionListTable.innerHTML += `
                <tr>
                    <td>${transaction.transaction_id}</td>
                    <td>${transaction.transaction_date}</td>
                    <td>${transaction.amount}</td>
                    <td>${transaction.from_account_id}</td>
                    <td>${transaction.to_account_id}</td>
                    <td>${transaction.description}</td>
                    <td>${transaction.status}</td>       
                </tr>
        `;
})


}





