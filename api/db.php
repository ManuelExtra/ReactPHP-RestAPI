<?php

    class db{

        /*
        *--Connecting to MySQL Database
        *--Returns a value
        */
        
        public static function connectDB(){
            $conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }
        
        /*
        *--Performing CRUD Operations on MySQL Database
        *--Returns a value
        */
        
        public static function queryDB($query, $params = array()){
            $statement = self::connectDB()->prepare($query);
            $statement->execute($params);
            if(explode(" ", $query)[0] == "SELECT"){
                $data = $statement->fetchAll();
                return $data;
            }
        }

    }

