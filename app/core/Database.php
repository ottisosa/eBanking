<?php

class conn
{

    public function connect()
    {

        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "eBanking";
        $puerto = 3306;

        $mysqli = new mysqli($host, $user, $pass, $db, $puerto);

        if ($mysqli->connect_error) {
            die("Connection failed: {$mysqli->connect_error}");
        }

        return $mysqli;
    }
}
