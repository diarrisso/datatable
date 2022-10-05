<?php
require_once __DIR__. "/config/Database.php";

require_once __DIR__."/Model/Ontouch.php";

if ( empty( $_POST['kundennummer'] ) ) {

    $db = new Database();
    $conn = $db->getConnection();
    if (!$conn) {
        die("Connection failed: ");
    }
    $serverside = array();
    $sql = "SELECT * FROM Blog.carrier  LIMIT ".$_REQUEST['start']." ,".$_REQUEST['length']." ";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();

    $count = "SELECT COUNT(*) FROM Blog.carrier ";
    $statement = $conn->query($count);
    $statement->execute();
    $countResult = $statement->fetchColumn();

    $json_data = array(
        "recordsTotal"    => intval( $countResult ),
        "recordsFiltered" => intval($countResult),
    );

    $data = array();

    foreach ($result as $value)
    {
        $modelCarrier = new Ontouch();

        $row ['DT_RowId'] =       $value['id'] ;
        $row ['kundennummer'] =   $value['kundennummer'] ;
        $row ['name'] =           $value['name'] ;
        $row ['urlSc'] =         $value['urlSc'] ;
        $row ['rufnummerSc'] =   $value['rufnummerSc'] ;
        $row ['urlCc'] =         $value['urlCc'] ;
        $row ['rufnummerCc'] =   $value['rufnummerCc'] ;
        $row ['auftraggsart'] =   $value['auftraggsart'] ;
        $data [] = $row;

    }

    $json_data ['data'] = $data;
    echo json_encode($json_data);
}







// function post insert;
$db = new Database();
$conn = $db->getConnection();

if ( dataValidion() !== true )
{
    echo json_encode( array ('error' => dataValidion() ) );
    exit();
}

if ( !empty($_POST['action']) && $_POST['action'] === 'addData' && dataValidion() )
//if ( !empty($_POST['kundennummer'])  && dataValidion() )
{

    $response = array();
    $kundenummer  = htmlspecialchars(trim($_POST['kundennummer']));
    $name         =  htmlspecialchars(trim($_POST['name']));
    $urlSc         =  htmlspecialchars(trim($_POST['urlSc']));
    $rufnummerSc         =  htmlspecialchars(trim($_POST['rufnummerSc']));
    $urlCc         =  htmlspecialchars(trim($_POST['urlCc']));
    $rufnummerCc  = htmlspecialchars(trim($_POST['rufnummerCc']));
    $auftraggsart = htmlspecialchars(trim($_POST['auftraggsart']));

    $insertQuery = "INSERT INTO Blog.carrier(carrier.kundennummer, carrier.name, carrier.urlSc, carrier.rufnummerSc, carrier.urlCc, carrier.rufnummerCc, carrier.auftraggsart) 
			VALUES ('".$kundenummer."', '".$name."', '".$urlSc."', '".$rufnummerSc."', '".$urlCc."','".$rufnummerCc."','".$auftraggsart."')";
    $statement = $conn->prepare($insertQuery);
    $statement->execute();

    echo  json_encode( array( 'Msg'=> 'les donnees ont ete enregistrer avec success') );

}






/**
 * @return array|true
 */
function dataValidion()
{
    if ( isset($_POST['kundennummer'] )  )
    {

        $output = array();

        if(!filter_var($_POST['kundennummer'], FILTER_VALIDATE_INT) || empty( $_POST['kundennummer'] ))
        { //email validation
            $output['kundennummer'] = 'bitte kein string';
        }

        if(is_numeric($_POST['name']) || strlen($_POST['name']) < 3  && empty( $_POST['name'])  )
        {
            $output['namee'] = 'Name muss ein string sein!';
        }

        if(!is_string($_POST['urlSc'] ) && !empty( $_POST['urlSc'] ))
        {
            $output['urlSce'] = 'urlsc link mit string';
        }


        if( !filter_var($_POST['rufnummerSc'], FILTER_SANITIZE_NUMBER_INT) &&  !empty( $_POST['rufnummerSc'])){ //check for valid numbers in phone number field
            $output['rufnummerSce'] = 'rufnummerSc nicht gut';
        }


        if( !filter_var($_POST['urlCc'], FILTER_SANITIZE_STRING) && !empty( $_POST['urlCc'])){ //
            $output['urlCce'] =  'urlcc';
        }

        if( !filter_var($_POST['rufnummerCc'], FILTER_SANITIZE_NUMBER_INT) && !empty( $_POST['rufnummerCc'])){ //check for valid numbers in phone number field
            $output['rufnummerCce'] = 'rufnummerCc BIITE';
        }


        if(is_numeric($_POST['auftraggsart']) && empty($_POST['auftraggsart'])  ){ //
            $output['auftraggsarte'] = 'auftrage nest pas bon';
        }


        if ( empty( $output ) === false)
        {

            return  $output;
        }


    }

    return true;

}

// update datatables
if ( !empty($_POST['action']) && $_POST['action'] === 'updateOnTouchCarrier' && dataValidion() ) {

    if( $_POST['id'] ) {
        $updateQuery = "UPDATE Blog.carrier 
			SET carrier.kundennummer = '".$_POST["kundennummer"]."', carrier.name = '".$_POST["name"]."', 
			 carrier.urlSc = '".$_POST["urlSc"]."', carrier.rufnummerSc = '".$_POST["rufnummerSc"]."' , 
			 carrier.urlCc = '".$_POST["urlSc"]."', carrier.rufnummerCc = '".$_POST["rufnummerCc"]."', carrier.auftraggsart = '".$_POST["auftraggsart"]."'
			WHERE carrier.id ='".$_POST["id"]."'";
        $isUpdated = $conn->prepare($updateQuery);
        $isUpdated->execute();
        echo json_encode( array ('Update' => 'les donnes ont ete mise en jour ') );
    }

}

