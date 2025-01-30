<?php

require_once "../models/Transaction.php";
require_once "../core/validateData.php";
require_once "../core/Response.php";

$function = $_GET['function'];
$transactionController = new TransactionController;

switch ($function) {

    case "register":
        $transactionController->register();
        break;

    case "getTransactions":
        $transactionController->getTransactions();
        break;
    case "getTransactionsById":
        $transactionController->getTransactionsById();
        break;
}

class TransactionController
{
    function register()
    {
        try {
            $validateData = new ValidateData;
            $response = new Response;

            $transaction = [
                "from_account_id" => $_POST['from_account_id'],
                "to_account_id" => $_POST['to_account_id'],
                "amount" => $_POST['amount'],
                "description" => $_POST['description']
            ];

            $sanitizeData = $validateData->sanitizeData($transaction);

            (new Transaction())->register($sanitizeData['from_account_id'], $sanitizeData['to_account_id'], $sanitizeData['amount'], $sanitizeData['description']);

            $response->setStatusCode(201);
            $response->setBody([
                'success' => true,
                'message' => 'Transaccion registrada correctamente.'
            ]);
        } catch (Exception $e) {
            $response->setStatusCode(400);
            $response->setBody([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
        ;
        $response->send();
    }

    function getTransactions()
    {
        try {
            $response = new Response;

            $result = (new Transaction())->getTransactions();

            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'Transacciones encontradas exitosamente.',
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

    function getTransactionsById()
    {

        $account_id = $_POST['account_id'];

        try {
            $response = new Response;

            $result = (new Transaction())->getTransactionsById($account_id);

            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'Transacciones encontradas exitosamente.',
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
