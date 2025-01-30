const resumeAccountsCard = document.querySelector("#resumeAccounts");
const transactionsListTable = document.querySelector("#transactionsList");


loadAccounts();
loadTransactions();


async function loadAccounts() {

    const response = await fetch("http://localhost/eBanking/app/controllers/AccountController.php?function=getAccounts");

    const result = await response.json();

    const accounts = result.data;

    accounts.forEach(account => {
        resumeAccountsCard.innerHTML += `
            <div class="card">
            <h2>Cuenta: ${account.account_id}</h2>
            <p>$ ${account.balance}</p>
            </div>
        `;
    });
}


async function loadTransactions() {

    const response = await fetch("http://localhost/eBanking/app/controllers/TransactionController.php?function=getTransactions");

    const result = await response.json();

    const transactions = result.data;

    if (transactions.length > 0) {

        transactions.forEach(transaction => {
            transactionsListTable.innerHTML += `
                <tr>
                    <td>${transaction.transaction_id}</td>
                    <td>${transaction.from_account_id}</td>
                    <td>${transaction.to_account_id}</td>
                    <td>${transaction.transaction_date}</td>
                    <td>${transaction.amount}</td>
                    <td>${transaction.status}</td>
                </tr>
        `;
        });

    }
}