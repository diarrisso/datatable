<?php
require_once __DIR__. "/config/Database.php";
require_once __DIR__."/Model/Ontouch.php";
require_once __DIR__."/lib/ExportService.php";
require_once __DIR__."/lib/Post.php";
$db = new Database();
$conn = $db->getConnection();
if (!$conn) {
    die('Connection failed: ');
}
if (empty($_POST['kundennummer']))  {


    $serverside = array();
    $where = '';
    $searchValue = $_REQUEST['search']['value'];
    //$columnsValue = $_REQUEST['columns']['search'];

    if ($_REQUEST['columns']) {
        foreach ($_REQUEST['columns'] as $key =>  $columns)
        {
            $search = $columns['search']['value'];
            $search2 = substr($search,4,-4);
            $searchreplac = str_replace('(())', '', $search);
            $data = $columns['data'];
            if ( $data === 'name') {
                error_log('>>>>>>>'. $search2);
                //where4 .= 'name like "' .$search2 . '"';

            }
        }
    }



    if ($searchValue)
    {
        $sqlfilter = "SELECT * FROM Blog.carrier where name  like '%".$searchValue."%' or  kundennummer like '%".$searchValue."%' or rufnummerSc like '%".$searchValue."%' 
         or rufnummerSc like '%".$searchValue."%' or urlCc   like  '%".$searchValue."%' or urlSc like '%".$searchValue."' or auftraggsart like '%".$searchValue."'";
        $stmt = $conn->prepare($sqlfilter);
        $stmt->execute();
        $result = $stmt->fetchAll();

    } else{
        $sqlfilter = "SELECT * FROM Blog.carrier $where LIMIT ".$_REQUEST['start']." ,".$_REQUEST['length']." ";
        $stmt = $conn->prepare($sqlfilter);
        $stmt->execute();
        $result = $stmt->fetchAll();

    }
    $count = "SELECT COUNT(*) FROM Blog.carrier ";
    $statement = $conn->query($count);
    $statement->execute();
    $countResult = $statement->fetchColumn();

    $json_data = array(
        //"draw"	=>	intval($_POST["draw"]),
        //"recordsTotal"    => intval( $countResult ),
        //"recordsFiltered" => intval($countResult),
        //"data"  => $countResult
    );

    $data = array();

    foreach ($result as $value)
    {
        $modelCarrier = new Ontouch();

        $row ['DT_RowId'] =       $value['id'] ;
        $row ['kundennummer'] =   $value['kundennummer'] ;
        $row ['name'] =           $value['name'] ;
        $row ['urlSc'] =          $value['urlSc'] ;
        $row ['rufnummerSc'] =    $value['rufnummerSc'] ;
        $row ['urlCc'] =          $value['urlCc'] ;
        $row ['rufnummerCc'] =    $value['rufnummerCc'] ;
        $row ['auftragsart'] =    $value['auftraggsart'] ;
        $data [] = $row;

    }

    $json_data ['data'] = $data;
    echo json_encode($json_data);

    return $json_data;

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
    $auftraggsart = htmlspecialchars(trim($_POST['auftragsart']));

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
function validateURL($URL): bool
{
    $pattern_1 = "%^(?:(?:https?|ftp|www|http)://)(?:\S+(?::\S*)?@|\d{1,3}(?:\.\d{1,3}){3}|(?:(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)(?:\.(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)*(?:\.[a-z\x{00a1}-\x{ffff}]{2,6}))(?::\d+)?(?:[^\s]*)?$%iu";
    $pattern_2 = "/^(www)((\.[A-Z0-9][A-Z0-9_-]*)+.(com|org|net|dk|at|us|tv|info|uk|co.uk|biz|se|de)$)(:(\d+))?\/?/i";
    $patterPortNumber = '/^https?:\/\/\w+(\.\w+)*(:[0-9]+)?(\/.*)?$/';
    if(preg_match('/^http(s?):\/\/(www\.)?(((\w+(([\.\-]{1}([a-z]{2,})+)+)(\/[a-zA-Z0-9\_\=\?\&\.\#\-\W]*)*$)|(\w+((\.([a-z]{2,})+)+)(\:[0-9]{1,5}(\/[a-zA-Z0-9\_\=\?\&\.\#\-\W]*)*$)))|(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}(([0-9]|([1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]+)+)(\/[a-zA-Z0-9\_\=\?\&\.\#\-\W]*)*)((\:[0-9]{1,5}(\/[a-zA-Z0-9\_\=\?\&\.\#\-\W]*)*$)*))$/', $URL)
    || preg_match($pattern_2, $URL) || preg_match($patterPortNumber, $URL))
    {
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
    /*if (!$result) {
        return  'le nummero nest pas bon';
    }*/
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

        if(!filter_var($_POST['kundennummer'], FILTER_VALIDATE_INT) || empty( $_POST['kundennummer'] ) || strlen( $_POST['kundennummer'] )!== 10 )
        {
            $output['kundennummer'] = ' Backend :Kundennumer muss 10 Zahl sein bitte';
        }

        if(is_numeric($_POST['name']) || strlen($_POST['name']) < 3  && empty( $_POST['name'])  )
        {
            $output['name'] = 'Backed: Name muss ein string sein!';
        }

        if(!validateURL( $_POST['urlSc'] ) && !empty( $_POST['urlSc'] ))
        {
            $output['urlSc'] = ' Backend: Bitte die URL ist nictt Valide';
        }

        if(!validRufnummer( $_POST['rufnummerSc'] ) && !empty( $_POST['rufnummerSc'] ))
        {
            $output['rufnummerSc'] = ' Backend: Bitte die URL ist nictt Valide';
        }


       /* $errorSc =  validRufnummer($_POST['rufnummerSc']);
        $errorCc =  validRufnummer($_POST['rufnummerCc']);*/
        //if ( !validRufnummer($_POST['rufnummerSc']) && !empty( $_POST['rufnummerSc']) || !validRufnummer( $_POST['rufnummerCc'] ) && !empty( $_POST['rufnummerCc']))
        /*if ( $errorCc && !empty( $_POST['rufnummerSc']) || $errorSc)
        {

            //if (array_keys($array))
            //$_POST[] = 'rufnummerSc';
            $haystack = 'rufnummerSc';
            $needle   = 'SC';
            $pos      = strripos($haystack, $needle);

            if ($_POST['rufnummerSc']) {

                $output['rufnummerSC'] = 'Backend: Bitte die RUFNUMMER_SC nicht valid';
            }

            if ($_POST['rufnummerCc']) {

                $output['rufnummerCc'] = 'Backend: Bitte die RUFNUMMER_Cc  nicht valid';
            }

            //$output['rufnummer'] = 'Backend: Bitte die RUFNUMMER_'.$needle.' nicht valid';

            //$output['rufnummer'] = 'Backend: Bitte die RUFNUMMER nicht valid';
        }*/

       if (!validateURL( $_POST['urlCc'])  && !empty( $_POST['urlCc']) ){ //
            $output['urlCc'] =  ' backend: urlcc ist not valid';
        }

        if( !validRufnummer($_POST['rufnummerCc']) && !empty( $_POST['rufnummerCc'])){ //check for valid numbers in phone number field
            $output['rufnummerCc'] = 'Backend: rufnummerCc BIITE cc';
        }


        if(is_integer($_POST['auftragsart']) && empty($_POST['auftragsart'])  ){ //
            $output['auftragsart'] = 'Backend Validierung ist nicht gut';
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
			 carrier.urlCc = '".$_POST["urlCc"]."', carrier.rufnummerCc = '".$_POST["rufnummerCc"]."', carrier.auftraggsart = '".$_POST["auftragsart"]."'
			WHERE carrier.id ='".$id."'";
        $isUpdated = $conn->prepare($updateQuery);
        $isUpdated->execute();
        echo json_encode( array ('Update' => 'les donnes ont ete mise en jour ') );
    }

}



if ( isset( $_GET['action']) && $_GET['action'] === 'import') {

    $getAllPost = new Post();
    $allPost = $getAllPost->getAllPost();
    $tester = new ExportService();
    try {
        $tester->exportExcel($allPost);
    } catch (\PhpOffice\PhpSpreadsheet\Writer\Exception|\PhpOffice\PhpSpreadsheet\Exception $e) {
        error_log('$message' . $e);
    }
}







