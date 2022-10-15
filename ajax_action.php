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

    $searchValue = $_REQUEST['search']['value'];

    if ($searchValue)
    {
        $sqlfilter = "SELECT * FROM Blog.carrier where name like '%".$searchValue."%'";
        $stmt = $conn->prepare($sqlfilter);
        $stmt->execute();
        $result = $stmt->fetchAll();

    }else{
        $sql = "SELECT * FROM Blog.carrier  LIMIT ".$_REQUEST['start']." ,".$_REQUEST['length']." ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
    }

    
    $count = "SELECT COUNT(*) FROM Blog.carrier ";
    $statement = $conn->query($count);
    $statement->execute();
    $countResult = $statement->fetchColumn();

    $json_data = array(
        "draw"	=>	intval($_POST["draw"]),
        "recordsTotal"    => intval( $countResult ),
        "recordsFiltered" => intval($countResult),
        //"data"  => $countResult
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

    echo  json_encode( array( 'Msg'=> 'les donnees ont ete enregistrer avec success', 'data' => $kundenummer ) );
}



/**
 * @param $URL
 * @return bool
 */
function validateURL($URL) {
    $pattern_1 = "%^(?:(?:https?|ftp|www|http)://)(?:\S+(?::\S*)?@|\d{1,3}(?:\.\d{1,3}){3}|(?:(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)(?:\.(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)*(?:\.[a-z\x{00a1}-\x{ffff}]{2,6}))(?::\d+)?(?:[^\s]*)?$%iu";
    //$pattern_1 = "/^(http|https|ftp):\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+.(com|org|net|dk|at|us|tv|info|uk|co.uk|biz|se|de)$)(:(\d+))?\/?/i";
    //$pattern_2 = "/^(www)((\.[A-Z0-9][A-Z0-9_-]*)+.(com|org|net|dk|at|us|tv|info|uk|co.uk|biz|se|de)$)(:(\d+))?\/?/i";
    //if(preg_match($pattern_1, $URL) || preg_match($pattern_2, $URL)){
   // if(preg_match('/(\w*\W*)?\w*(\.(\w)+)+(\W\d+)?(\/\w*(\W*\w)*)*/', $URL)  ){
    if(preg_match('/^http(s?):\/\/(www\.)?(((\w+(([\.\-]{1}([a-z]{2,})+)+)(\/[a-zA-Z0-9\_\=\?\&\.\#\-\W]*)*$)|(\w+((\.([a-z]{2,})+)+)(\:[0-9]{1,5}(\/[a-zA-Z0-9\_\=\?\&\.\#\-\W]*)*$)))|(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}(([0-9]|([1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]+)+)(\/[a-zA-Z0-9\_\=\?\&\.\#\-\W]*)*)((\:[0-9]{1,5}(\/[a-zA-Z0-9\_\=\?\&\.\#\-\W]*)*$)*))$/', $URL)  ){
        return true;
    } else{
        return false;
    }
}

/**
 * @param $rufnummer
 * @return false|int
 */
function validRufnummer($rufnummer)
{
    $pattern = '/^[0:]([0-9]{11,18})$/';
    $result = preg_match($pattern,$rufnummer);

    return $result;
}

/**
 * @return array|true
 */
function dataValidion()
{

    $regex = "((https?|ftp)\:\/\/)?";
    $regex .= "([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?";
    $regex .= "([a-z0-9-.]*)\.([a-z]{2,3})";
    $regex .= "(\:[0-9]{2,5})?";
    $regex .= "(\/([a-z0-9+\$_-]\.?)+)*\/?";
    $regex .= "(\?[a-z+&\$_.-][a-z0-9;:@&%=+\/\$_.-]*)?";
    $regex .= "(#[a-z_.-][a-z0-9+\$_.-]*)?";


    if ( isset($_POST['kundennummer'] )  )
    {

        $output = array();

        if(!filter_var($_POST['kundennummer'], FILTER_VALIDATE_INT) || empty( $_POST['kundennummer'] ))
        { //email validation
            $output['kundennummer'] = 'bitte kein string';
        }

        if(is_numeric($_POST['name']) || strlen($_POST['name']) < 3  && empty( $_POST['name'])  )
        {
            $output['name'] = 'Name muss ein string sein!';
        }


        if(!validateURL( $_POST['urlSc'] ) && !empty( $_POST['urlSc'] ))

        {
            $output['urlSc'] = ' backend: urlsc ist noi valid';
        }


        if( !validRufnummer($_POST['rufnummerSc']) &&  !empty( $_POST['rufnummerSc'])){ //check for valid numbers in phone number field
            $output['rufnummerSc'] = ' Backend: rufnummerSc nicht gut';
        }



        if (!validateURL( $_POST['urlCc'])  && !empty( $_POST['urlCc']) ){ //
            $output['urlCc'] =  ' backend: urlcc ist not valid';
        }

        if( !validRufnummer($_POST['rufnummerCc']) && !empty( $_POST['rufnummerCc'])){ //check for valid numbers in phone number field
            $output['rufnummerCc'] = 'Backend: rufnummerCc BIITE';
        }


        if(is_integer($_POST['auftraggsart']) && empty($_POST['auftraggsart'])  ){ //
            $output['auftraggsart'] = 'Backend Validierung ist nicht gut';
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

   $id  = $_REQUEST['id'] ;

    if( $id ) {
        $updateQuery = "UPDATE Blog.carrier 
			SET carrier.kundennummer = '".$_POST["kundennummer"]."', carrier.name = '".$_POST["name"]."', 
			 carrier.urlSc = '".$_POST["urlSc"]."', carrier.rufnummerSc = '".$_POST["rufnummerSc"]."' , 
			 carrier.urlCc = '".$_POST["urlCc"]."', carrier.rufnummerCc = '".$_POST["rufnummerCc"]."', carrier.auftraggsart = '".$_POST["auftraggsart"]."'
			WHERE carrier.id ='".$id."'";
        $isUpdated = $conn->prepare($updateQuery);
        $isUpdated->execute();
        echo json_encode( array ('Update' => 'les donnes ont ete mise en jour ') );
    }

}

