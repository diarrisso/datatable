<?php




class Database {

        public function __construct( )
        {

        }


        public function  getConnection()
        {


            $servername = "localhost:3306";
            $username = "root";
            $password = "root";

            try {
                $conn = new PDO("mysql:host=$servername;dbname=Blog", $username, $password);
                // set the PDO error mode to exception
                //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                //echo "Connected successfully";
            } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
            return $conn;

       }
}