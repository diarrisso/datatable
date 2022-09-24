<?php

require_once __DIR__. "/config/Database.php";

require_once __DIR__."/Model/Ontouch.php";

if (empty($_POST['kundennummer'])) {




    $db = new Database();
    $conn = $db->getConnection();


    if (!$conn) {
        die("Connection failed: ");
    }

    $sql = "SELECT * FROM Blog.carrier";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();


    $data = array();

    foreach ($result as $value)

    {
        $modelCarrier = new Ontouch();

        $row ['id'] =   $value['id'] ;
        $row ['kundennummer'] =   $value['kundennummer'] ;
        $row ['name'] =   $value['name'] ;
        $row ['urlSc'] =   $value['urlSc'] ;
        $row ['rufnummerSc'] =   $value['rufnummerSc'] ;
        $row ['urlCc'] =   $value['urlCc'] ;
        $row ['rufnummerCc'] =   $value['rufnummerCc'] ;
        $row ['auftraggsart'] =   $value['auftraggsart'] ;
        $data [] = $row;

    }
    echo json_encode($data);
}

// function post insert;

/*
$error = array();
if (!empty($_POST['kundennummer'])) {

    $error = "das nist kein zahl";

}

echo json_encode($error);*/










