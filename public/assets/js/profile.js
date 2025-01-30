const formChangePass = document.querySelector("#changePassword");
const newPasswordInput = document.querySelector('#new_password');
const confirmPasswordInput = document.querySelector('#confirm_password');
const profile =document.querySelector('#editar-perfil');


formChangePass.onsubmit = async (e) => {
    e.preventDefault();

    if(newPasswordInput.value === confirmPasswordInput.value){
        let passwordData = new FormData(formChangePass);

        let url = 'http://localhost/eBanking/app/controllers/UserController.php?function=updatePassword';
    
        let config = {
            method: 'POST',
            body: passwordData
        };
    
        let response = await fetch(url, config);
    
        const result = await response.json();
    
        if(result.success){
            alert(result.message);
            formChangePass.reset();
        } else {
            alert(result.error)
        }
    } else {
        alert("La nueva contraseña no coincide con su confirmación.")
    }
}

 /*async function profile (nombre-completo, nombre-usuario, email, telefono ) {


}*/
