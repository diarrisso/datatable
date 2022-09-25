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

        $row ['id'] =       $value['id'] ;
        $row ['kundennummer'] =   $value['kundennummer'] ;
        $row ['name'] =           $value['name'] ;
        $row ['urlSc'] =         $value['urlSc'] ;
        $row ['rufnummerSc'] =   $value['rufnummerSc'] ;
        $row ['urlCc'] =         $value['urlCc'] ;
        $row ['rufnummerCc'] =   $value['rufnummerCc'] ;
        $row ['auftraggsart'] =   $value['auftraggsart'] ;
        $data [] = $row;


    }
    echo json_encode($data);
}



// function post insert;
$db = new Database();
$conn = $db->getConnection();
//if (!empty($_POST['action']) && $_POST['action'] == 'addEmployee'){
if ( !empty($_POST['kundennummer']) )
{


    $response = array();
    $kundenummer  = $_POST['kundennummer'];

        $name         =  htmlspecialchars(trim($_POST['name']));
        $urlSc         =  htmlspecialchars(trim($_POST['urlSc']));
        $rufnummerSc         =  htmlspecialchars(trim($_POST['rufnummerSc']));
        $urlSc         =  htmlspecialchars(trim($_POST['urlSc']));
        $urlCc         =  htmlspecialchars(trim($_POST['urlCc']));
        $rufnummerCc  = htmlspecialchars(trim($_POST['rufnummerCc']));
        $auftraggsart = htmlspecialchars(trim($_POST['auftraggsart']));


        //Sanitize input data using PHP filter_var().
        $kundenummer =   filter_var($_POST["kundennummer"], FILTER_SANITIZE_NUMBER_INT);
        $name      =     filter_var($_POST["name"], FILTER_SANITIZE_STRING);
        $urlSc     =     filter_var($_POST["urlSc"], FILTER_SANITIZE_STRING);
        $rufnummerSc   = filter_var($_POST["rufnummerSc"], FILTER_SANITIZE_NUMBER_INT);
        $rufnummerCc   = filter_var($_POST["rufnummerCc"], FILTER_SANITIZE_NUMBER_INT);
        $urlCc        = filter_var($_POST["urlCc"], FILTER_SANITIZE_STRING);
        $auftraggsart        = filter_var($_POST["auftraggsart"], FILTER_SANITIZE_STRING);


        //error_log('>>>>>>>'.$auftraggsart);
        $output = array();

        //additional php validation

    if(!filter_var($kundenummer, FILTER_SANITIZE_NUMBER_INT)){ //email validation
        $output = json_encode(array('type'=>'error', 'text' => 'kundennnumer!'));
        die($output);

    }



    if(is_numeric($name) || strlen($name) < 3 )
    {
        $output = json_encode(array('type'=>'error', 'text' => 'Name muss ein string sein!'));
        die($output);
    }



    if(!filter_var($urlSc, FILTER_SANITIZE_STRING) && !empty($urlSc)){ //
        $output = json_encode(array('type'=>'error', 'text' => 'urlsc link mit string'));
        die($output);

    }



    if(!filter_var($rufnummerSc, FILTER_SANITIZE_NUMBER_FLOAT) &&  !empty($rufnummerSc)){ //check for valid numbers in phone number field
        $output = json_encode(array('type'=>'error', 'text' => 'rufnummerSc'));
        die($output);

    }



    if(!filter_var($urlCc, FILTER_SANITIZE_STRING) && !empty($urlCc)){ //
        $output = json_encode(array('type'=>'error', 'text' => 'urlcc'));
        die($output);
    }


    if(!filter_var($rufnummerCc, FILTER_SANITIZE_NUMBER_FLOAT) && !empty($rufnummerCc)){ //check for valid numbers in phone number field
        $output = json_encode(array('type'=>'error', 'text' => 'rufnummerCc BIITE'));
        die($output);

    }




    if(is_numeric($auftraggsart) || strlen($auftraggsart) <= 1 ){ //
        $output = json_encode(array('type'=>'error', 'text' => '$auftraggsart'));
        die($output);

    }

    echo json_encode($output);




        //echo json_encode($output);


        $insertQuery = "INSERT INTO Blog.carrier(carrier.kundennummer, carrier.name, carrier.urlSc, carrier.rufnummerSc, carrier.urlCc, carrier.rufnummerCc, carrier.auftraggsart) 
			VALUES ('".$kundenummer."', '".$name."', '".$urlSc."', '".$rufnummerSc."', '".$urlCc."','".$rufnummerCc."','".$auftraggsart."')";
        $statement = $conn->prepare($insertQuery);
        $statement->execute();



}









