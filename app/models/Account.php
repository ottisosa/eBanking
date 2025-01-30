<?php

require_once "../core/Database.php";


class Account
{

    //  Función para crear una cuenta
    function create()
    {
        try {

            $connection = new conn;
            $conn = $connection->connect();

            session_start();
            $user_id = $_SESSION['user_id'];

            $sql = "INSERT INTO accounts (user_id) VALUES($user_id);";
            $response = $conn->query($sql);

            // Obtener el id del ultimo registro insertado
            $last_id = $conn->insert_id;

            $account_id = 'ACC' . str_pad($last_id, 6, '0', STR_PAD_LEFT);
            $sql = "UPDATE accounts SET account_id = '$account_id' WHERE id = '$last_id'";
            $response = $conn->query($sql);

            return $response;

        } catch (Exception $e) {
            throw new Exception("Error al crear la cuenta: " . $e->getMessage());
        }
    }




    function rechargeBalance($account_id, $amount)
    {
        $connection = new conn;
        $conn = $connection->connect();


        try {

            $currentBalance = $this->getBalance($account_id);
            $newBalance = $currentBalance['balance'] + $amount;
            $sql = "UPDATE accounts SET balance = '$newBalance' WHERE account_id = '$account_id';";
            $response = $conn->query($sql);

            $filas_afectadas = $conn->affected_rows;

            if (!($filas_afectadas > 0)) {
                return false;
            }
            return true;
        } catch (Exception $e) {
            throw new Exception("Error al recargar la cuenta: " . $e->getMessage());
        }

    }


    function getBalance($account_id)
    {

        $connection = new conn;
        $conn = $connection->connect();


        try {
            $sql = "SELECT balance FROM accounts WHERE account_id = '$account_id';";
            $response = $conn->query($sql);
            $result = $response->fetch_assoc();
            return $result;
        } catch (Exception $e) {
            throw new Exception("Error al obtener saldo: " . $e->getMessage());
        }

    }


    function getAccountsList()
    {

        $connection = new conn;
        $conn = $connection->connect();

        try {

            session_start();
            $user_id = $_SESSION['user_id'];

            $sql = "SELECT * FROM accounts WHERE user_id = '$user_id';";
            $response = $conn->query($sql);
            $result = $response->fetch_all(MYSQLI_ASSOC);
            return $result;
        } catch (Exception $e) {
            throw new Exception("Error al obtener las cuentas del usuario: " . $e->getMessage());
        }

    }

    function verifyAccount($account_id)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();

            $sql = "SELECT u.full_name
                    FROM users u
                    JOIN accounts a ON u.user_id = a.user_id
                    WHERE a.account_id = '$account_id';";
                    
            $response = $conn->query($sql);
            $result = $response->fetch_assoc();

            return $result;
        } catch (Exception $e) {
            throw new Exception("Error al obtener el nombre del usuario: " . $e->getMessage());
        }
    }


}
