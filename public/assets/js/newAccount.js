const checkTerms = document.querySelector("#aceptar-terminos");
const formNewAccount = document.querySelector("#newAccount");


formNewAccount.onsubmit = async (e) => {
    e.preventDefault();

    if (checkTerms.checked) {

        let url = 'http://localhost/eBanking/app/controllers/AccountController.php?function=create';

        let response = await fetch(url);

        const result = await response.json();

        alert(result.message);

    } else {
        alert("Debe aceptar los terminos y condiciones");
    }
}
