<?php

require_once "../models/User.php";
require_once "../core/validateData.php";
require_once "../core/Response.php";

$function = $_GET['function'];
$userController = new UserController;

switch ($function) {
    case "login":
        $userController->login();
        break;

    case "register":
        $userController->register();
        break;

    case "updatePassword":
        $userController->updatePassword();
        break;

    case "updateProfile":
        $userController->updateProfile();
        break;

    case "logout":
        $userController->logout();
        break;
}


class UserController
{

    function login()
    {
        try {

            $validateData = new ValidateData;
            $response = new Response;

            $user = [
                "email" => $_POST['email'],
                "password" => $_POST['password']
            ];

            $sanitizeData = $validateData->sanitizeData($user);

            (new User())->login($sanitizeData['email'], $sanitizeData['password']);

            // Responder con el usuario logueado
            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'Usuario logueado exitosamente.'
            ]);
        } catch (Exception $e) {

            // Responder con un error
            $response->setStatusCode(400); // Código de estado para solicitud incorrecta
            $response->setBody([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }

        $response->send();
    }


    function register()
    {
        try {
            $validateData = new ValidateData;
            $response = new Response;

            $user = [
                "username" => $_POST['username'],
                "email" => $_POST['email'],
                "password" => $_POST['password'],
                "full_name" => $_POST['full_name'],
                "phone" => $_POST['phone']
            ];

            $sanitizeData = $validateData->sanitizeData($user);

            (new User())->register($sanitizeData['username'], $sanitizeData['email'], $sanitizeData['password'], $sanitizeData['full_name'], $sanitizeData['phone']);


            // Responder con el usuario creado
            $response->setStatusCode(201);
            $response->setBody([
                'success' => true,
                'message' => 'Usuario creado exitosamente.'
            ]);
        } catch (Exception $e) {
            // Responder con un error
            $response->setStatusCode(400);
            $response->setBody([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }

        $response->send();
    }

    function updatePassword()
    {
        try {
            $response = new Response;

            $user = [
                "new_password" => $_POST['new_password'],
                "current_password" => $_POST['current_password']
            ];

            (new User())->updatePassword($user['current_password'], $user['new_password']);

            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'Contraseña actualizada exitosamente.'
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


    function updateProfile()
    {
        try {
            $response = new Response;

            $user = [
                "username" => $_POST['username'],
                "email" => $_POST['email'],
                "full_name" => $_POST['full_name'],
                "phone" => $_POST['phone'],
            ];
            (new User())->updateWithoutPassword($user['username'], $user['email'], $user['full_name'], $user['phone']);

            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'Perfil actualizado exitosamente.'
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


    function logout()
    {
        $user = new User();
        if ($user->logout()) {
            header('Location: http://localhost/eBanking/public');
            exit();
        } else {
            echo "Error al cerrar sesión.";
        }
    }
}
