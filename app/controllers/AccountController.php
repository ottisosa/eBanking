<?php

require_once "../core/Response.php";
require_once "../models/Account.php";

$function = $_GET['function'];

$accountController = new AccountController;

switch ($function) {

    case "create":
        $accountController->create();
        break;

    case "recharge":
        $accountController->recharge();
        break;

    case "getAccounts":
        $accountController->getAccounts();
        break;

    case "verifyAccount":
        $accountController->verifyAccount();
        break;
}


class AccountController
{
    function create()
    {
        try {
            $response = new Response;

            (new Account())->create();

            $response->setStatusCode(201);
            $response->setBody([
                'success' => true,
                'message' => 'Cuenta creada exitosamente.',
            ]);
        } catch (Exception $e) {
            $response->setStatusCode(400);
            $response->setBody([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }

        $response->send();
    }

    function recharge()
    {
        try {
            $response = new Response;

            $account_id = $_POST['account_id'];
            $amount = $_POST['amount'];



            $result = (new Account())->rechargeBalance($account_id, $amount);

            if (!$result) {
                throw new Exception("Error al recargar la cuenta");
            }

            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'Cuenta cargada exitosamente.',
            ]);
        } catch (Exception $e) {
            $response->setStatusCode(400);
            $response->setBody([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
        $response->send();
    }

    function getAccounts()
    {
        try {
            $response = new Response;

            $result = (new Account())->getAccountsList();


            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'Cuentas encontradas exitosamente.',
                'data' => $result
            ]);
        } catch (Exception $e) {

            $response->setStatusCode(400);
            $response->setBody([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
        $response->send();
    }


    function verifyAccount()
    {
        try {
            $response = new Response;

            $account_id = $_POST['account_id'];

            $result = (new Account())->verifyAccount($account_id);


            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'Cuenta encontradas exitosamente.',
                'data' => $result
            ]);
            
        } catch (Exception $e) {

            $response->setStatusCode(400);
            $response->setBody([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
        $response->send();
    }

}
