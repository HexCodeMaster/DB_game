<?php

namespace Mastermind;
use PDO;

use PDOException;

class Db
{
    protected function connect()
    {
        try {
            $host = 'localhost';
            $dbname = 'mastermind';
            $user = 'root';
            $password = 'root';
            $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
            //print "Connected successfully"; // Fixed typo here
            return $db;

        } catch (PDOException $e) {
            print "Connection failed: " . $e->getMessage();
            die();
        }
    }

}

