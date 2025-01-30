<?php

require_once "../core/Database.php";

class Transaction
{

    //  Función para registro de usuarios
    function register($fromAccountId, $toAccountId, $amount, $description)
    {
        $connection = new conn;
        $conn = $connection->connect();
        try {

            $sql = "SELECT balance FROM accounts WHERE account_id = '$fromAccountId';";
            $response = $conn->query($sql);
            $resultAmountOrigin = $response->fetch_assoc();

            $status = NULL;
            if ($resultAmountOrigin['balance'] < $amount) {
                $status = "Rechazada";
            } else {
                $status = "Completada";
            }

            $sql = "INSERT INTO transactions (from_account_id, to_account_id, amount, description, status) VALUES('$fromAccountId','$toAccountId', '$amount','$description', '$status');";

            $response = $conn->query($sql);

            if ($status != "Rechazada") {
                $sql = "SELECT balance FROM accounts WHERE account_id = '$toAccountId';";
                $response = $conn->query($sql);
                $originalAmount = $response->fetch_assoc();

                $newBalance = $originalAmount['balance'] + $amount;

                $sql = "UPDATE accounts SET balance = '$newBalance' WHERE account_id = '$toAccountId'";
                $response = $conn->query($sql);


                $sql = "SELECT balance FROM accounts WHERE account_id = '$fromAccountId';";
                $response = $conn->query($sql);
                $originalAmount = $response->fetch_assoc();
                $newBalance = $originalAmount['balance'] - $amount;
                $sql = "UPDATE accounts SET balance = '$newBalance' WHERE account_id = '$fromAccountId'";
                $response = $conn->query($sql);
            } else {
                throw new Exception("Transaccion rechazada por fondos insuficientes");
            }
            return $response;
        } catch (Exception $e) {
            throw new Exception("Error al registrar la transacción: " . $e->getMessage());
        }
    }


    function getTransactions()
    {

        $connection = new conn;
        $conn = $connection->connect();

        try {

            session_start();
            $user_id = $_SESSION['user_id'];

            $sql = "SELECT * FROM accounts WHERE user_id = '$user_id';";
            $response = $conn->query($sql);
            $accounts = $response->fetch_all(MYSQLI_ASSOC);

            $transactions = []; // Array asociativo para guardar las transacciones
            $transaction_ids = []; // Array asociativo para verificar IDs únicos de transacciones


            foreach ($accounts as $account) {

                $account_id = $account['account_id'];

                $sql = "SELECT * FROM transactions WHERE from_account_id = '$account_id'  OR to_account_id = '$account_id' ORDER BY transaction_date DESC LIMIT 10;";

                $response = $conn->query($sql);

                $account_transactions = $response->fetch_all(MYSQLI_ASSOC);

                foreach ($account_transactions as $transaction) {
                    $transaction_id = $transaction['transaction_id'];
                    //Si no existe el id de la transacción en el array TRANSACTIONS[], entonces lo agrega
                    if (!isset($transaction_ids[$transaction_id])) { //Verificar que en el array de IDs transacciones no existe el indice ID que se está iterando
                        $transaction_ids[$transaction_id] = true; // Marcar el ID como utilizado
                        $transactions[] = $transaction; // Agregar la transacción al array numérico
                    }                
                }
            }


            return $transactions;
        } catch (Exception $e) {
            throw new Exception("Error al obtener las cuentas del usuario: " . $e->getMessage());
        }
    }

    function getTransactionsById($account_id)
    {

        $connection = new conn;
        $conn = $connection->connect();

        try {

            $sql = "SELECT * FROM transactions WHERE from_account_id = '$account_id'  OR to_account_id = '$account_id';";
            $response = $conn->query($sql);
            $result = $response->fetch_all(MYSQLI_ASSOC);

            return $result;
        } catch (Exception $e) {
            throw new Exception("Error al obtener las cuentas del usuario: " . $e->getMessage());
        }
    }
}
