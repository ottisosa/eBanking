<?php

require_once "../core/Database.php";
session_start();

class User
{
    //  Función para registro de usuarios
    function register($username, $email, $password, $full_name, $phone)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $sql = "INSERT INTO users (username, password_hash, email, full_name, phone) VALUES('$username','$hashedPassword', '$email','$full_name', '$phone');";
            $response = $conn->query($sql);

            return $response;
        } catch (Exception $e) {
            throw new Exception("Error al crear el usuario: " . $e->getMessage());
        }
    }

    //  Función para login de usuarios
    function login($email, $password)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();

            $sql = "SELECT * FROM users WHERE email='$email';";

            $response = $conn->query($sql);
            $user = $response->fetch_assoc();

            if (!password_verify($password, $user['password_hash'])) {
                throw new Exception("Error al loguear el usuario: email o contraseña incorrecto");
            }

            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['full_name'] = $user['full_name'];

            return $user;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    //  Función para actualizar los usuarios sin la contraseña

    public function updateWithoutPassword($username, $email, $full_name, $phone)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();

            $userId = $_SESSION['user_id'];

            $sql = "UPDATE users SET username = '$username', email = '$email', full_name = '$full_name', phone = '$phone' WHERE user_id = '$userId';";
            $response = $conn->query($sql);
            $users = $response->fetch_all(MYSQLI_ASSOC);
            return $users;
        } catch (Exception) {
            return "Error";
        }
    }

    // Método para actualizar solo la contraseña del usuario
    public function updatePassword($currentPassword, $newPassword)
    {

        try {
            $connection = new conn;
            $conn = $connection->connect();

            $userId = $_SESSION['user_id'];

            $sql = "SELECT password_hash FROM users WHERE user_id = '$userId'";
            $response = $conn->query($sql);
            $result = $response->fetch_assoc();
            if ($result == NULL) {
                throw new Exception("No se encontro la contraseña del usuario");
            } else {
                if (!password_verify($currentPassword, $result['password_hash'])) {
                    throw new Exception("La contraseña actual no coincide");
                }
            }

            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT); // para hashear la contraseña 

            $sql = "UPDATE users SET password_hash = '$hashedPassword' WHERE user_id = '$userId'";
            $response = $conn->query($sql);

            return $response;
        } catch (Exception $e) {
            throw new Exception("Error al actualizar la contraseña: " . $e->getMessage());
        }
    }

    public function logout()
    {
        session_destroy();

        // Opcionalmente, borra la cookie de la sesión
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        return true;
    }

}
