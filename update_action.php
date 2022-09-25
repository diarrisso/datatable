<?php
require_once __DIR__. "/config/Database.php";

//var_dump($_GET['id']);die();

    if ( !empty($_GET['id']))
    {
        $id = $_GET['id'];
        error_log('id >>>>>'. $id);
        //$emp->getEmployee();
        $db = new Database();
        $conn = $db->getConnection();

        $sql = "SELECT * FROM Blog.carrier where carrier.id = '".$id."'";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $getresult = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($getresult);


    }