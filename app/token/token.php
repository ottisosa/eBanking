<?php


class token{

        //  Funcion para creacion de tokens

    function createToken($username)
    {

        $secretKey = 'secretToken666';

         global $secretKey;


        $token = base64_encode(json_encode(['username' => $username, 'exp' => time() + 60]));


        $signature = hash_hmac('sha256', $token, $secretKey);

        return $token . '.' . $signature;
    }

    function verifyToken($token) 
    {
        global $secretKey;

        list($encodedPayload, $signature) = explode('.', $token);

        //Para verificar la firma

        if (hash_hmac('sha256',$encodedPayload,$secretKey) !==$signature)
        {

            return null; //token invalido
        }

        $payload = json_decode(base64_decode($encodedPayload), true);


        // Verifica si el token expiro

        if ($payload['exp'] < time()){

            return null; //Token expiro
        }
        return $payload; //Token valido
    }


    // Rutas //

         if($_SERVER['REQUEST_METHOD']==='POST'&& $_SERVER['REQUEST_URI']==='app/token/token.php'){

             $username = $_POST['username'];
             $password = $_POST['password'];

    

             if($username = $username && $password = $password){

                $token = createToken($username);
                echo json_encode(['token'=>$token]);
             }else{

                http_response_code(401);
                echo json_encode(['error'=>'credenciales invalidas']);
             }

         }

}