<?php
require_once __DIR__. "/config/Database.php";

//ar_dump($_POST['action']);die();

    if ( !empty($_POST['id']))
    {
        $id = $_POST['id'];
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

;

if (!empty($_POST['action']) && $_POST['action'] == 'updateOnTouchCarrier') {
var_dump($_POST['action']);
    if($_POST['id']) {
        $updateQuery = "UPDATE Blog.carrier 
			SET carrier.kundennummer = '".$_POST["kundennummer"]."', carrier.name = '".$_POST["name"]."', 
			 carrier.urlSc = '".$_POST["urlSc"]."', carrier.rufnummerSc = '".$_POST["rufnummerSc"]."' , 
			 carrier.urlCc = '".$_POST["urlScc"]."', carrier.rufnummerCc = '".$_POST["rufnummerCc"]."', carrier.auftraggsart = '".$_POST["auftraggsart"]."'
			WHERE carrier.id ='".$_POST["id"]."'";
        $isUpdated = $conn->prepare($updateQuery);
        $isUpdated->execute();
        echo json_encode(
            $isUpdated
        );
    }
}