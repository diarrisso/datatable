<?php

class Post
{

    public function getConnection()
    {


        $servername = 'localhost:3306';
        $username = 'root';
        $password = 'root';

        try {
            $conn = new PDO("mysql:host=$servername;dbname=Blog", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully";
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        return $conn;

    }

    public function getAllPost()
    {

        $conn = $this->getConnection();
        $query = 'select  Blog.carrier.id, carrier.kundennummer, carrier.name, carrier.urlSc, carrier.rufnummerSc,  carrier.urlCc, carrier.rufnummerCc, carrier.auftraggsart From Blog.carrier ';
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getColumnName()
    {
        $result = array('id', 'name', 'kundennummer','urlSc', 'rufnummerSc', 'urlCc', 'rufnummerCc', 'Aufragsart');
        return $result;
    }
}