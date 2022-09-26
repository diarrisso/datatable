<?php
/*$scriptdomain = "http://localhost:8022/ajax_action.php";
header("Access-Control-Allow-Origin: $scriptdomain");*/
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
        $kundenummer  = htmlspecialchars(trim($_POST['kundennummer']));

        $name         =  htmlspecialchars(trim($_POST['name']));
        $urlSc         =  htmlspecialchars(trim($_POST['urlSc']));
        $rufnummerSc         =  htmlspecialchars(trim($_POST['rufnummerSc']));
        $urlSc         =  htmlspecialchars(trim($_POST['urlSc']));
        $urlCc         =  htmlspecialchars(trim($_POST['urlCc']));
        $rufnummerCc  = htmlspecialchars(trim($_POST['rufnummerCc']));
        $auftraggsart = htmlspecialchars(trim($_POST['auftraggsart']));


        //Sanitize input data using PHP filter_var().
      /*  $kundenummer =   filter_var($_POST["kundennummer"], FILTER_VALIDATE_INT);
        $name      =     filter_var($_POST["name"], FILTER_SANITIZE_STRING);
        $urlSc     =     filter_var($_POST["urlSc"], FILTER_SANITIZE_STRING);
        $rufnummerSc   = filter_var($_POST["rufnummerSc"], FILTER_SANITIZE_NUMBER_INT);
        $rufnummerCc   = filter_var($_POST["rufnummerCc"], FILTER_SANITIZE_NUMBER_INT);
        $urlCc        = filter_var($_POST["urlCc"], FILTER_SANITIZE_STRING);
        $auftraggsart        = filter_var($_POST["auftraggsart"], FILTER_SANITIZE_STRING);*/


        //error_log('>>>>>>>'.$auftraggsart);
        $output = array();

        //additional php validation

    if(!filter_var($kundenummer, FILTER_VALIDATE_INT)){ //email validation
        $output = array('type'=>'kundennummer', 'text' => 'bitte kein string');

    }


    if(is_numeric($name) || strlen($name) < 3  && !empty($name) )
    {
        $output = array('type'=>'name', 'text' => 'Name muss ein string sein!');

    }


    if(!is_string($urlSc ) && !empty($urlSc))
    {
        $output = array('type'=>'urlsc', 'text' => 'urlsc link mit string');


    }


    if(!filter_var($rufnummerSc, FILTER_SANITIZE_NUMBER_INT) &&  !empty($rufnummerSc)){ //check for valid numbers in phone number field
        $output = array('type'=>'rufnummer', 'text' => 'rufnummerSc');

    }


    if(!filter_var($urlCc, FILTER_SANITIZE_STRING) && !empty($urlCc)){ //
        $output = array('type'=>'urlcc', 'text' => 'urlcc');

    }


    if(!filter_var($rufnummerCc, FILTER_SANITIZE_NUMBER_INT) && !empty($rufnummerCc)){ //check for valid numbers in phone number field
        $output = array(
            'type'=>'auftragsart',
            'text' => 'rufnummerCc BIITE'
        );

    }


    if(is_numeric($auftraggsart) && !empty($rufnummerCc)  ){ //
        $output[] =  array(
            'type'=>'error',
            'text' => 'auftrage nest pas bon'

        );

    }

    if (!empty( $output ) )
    {

        echo json_encode($output);
        exit();
    }
    else {


        $insertQuery = "INSERT INTO Blog.carrier(carrier.kundennummer, carrier.name, carrier.urlSc, carrier.rufnummerSc, carrier.urlCc, carrier.rufnummerCc, carrier.auftraggsart) 
			VALUES ('".$kundenummer."', '".$name."', '".$urlSc."', '".$rufnummerSc."', '".$urlCc."','".$rufnummerCc."','".$auftraggsart."')";
        $statement = $conn->prepare($insertQuery);
        $statement->execute();
    }



    print_r(json_encode(array($output)));


}
//var_dump($_POST);









/*

 function getOntouchCarrier()
 {
     $db = new Database();
     $conn = $db->getConnection();
     if ($_POST['id']) {

         $sql = "SELECT * FROM Blog.carrier where carrier.id = '".$_POST['id']."'";

         $stmt = $conn->prepare($sql);
         $stmt->execute();
         $result = $stmt->fetchColumn();
         var_dump($result);

     }


}*/







