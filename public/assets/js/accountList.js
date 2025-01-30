const accountsListTable = document.querySelector("#accountsList");

loadAccounts();


async function loadAccounts() {

    const response = await fetch("http://localhost/eBanking/app/controllers/AccountController.php?function=getAccounts");

    const result = await response.json();

    const accounts = result.data;

    accounts.forEach(account => {
        accountsListTable.innerHTML += `
            <tr>
            <td>${account.account_id}</td>
            <td>${account.balance}</td>
            </tr>      
        `;
    });
}
