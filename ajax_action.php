<?php



$record = new Records();
if(!empty($_POST['action']) && $_POST['action'] == 'listRecords') {
    $record->listRecords();
}


$database = new Database();
$db = $database->getConnection();

$record = new Records($db);

if(!empty($_POST['action']) && $_POST['action'] == 'updateRecord') {
$record->id = $_POST["id"];
$record->name = $_POST["name"];
$record->age = $_POST["age"];
$record->skills = $_POST["skills"];
$record->address = $_POST["address"];
$record->designation = $_POST["designation"];
$record->updateRecord();
}



$database = new Database();
$db = $database->getConnection();

$record = new Records($db);

if(!empty($_POST['action']) && $_POST['action'] == 'deleteRecord') {
    $record->id = $_POST["id"];
    $record->deleteRecord();
}


$database = new Database();
$db = $database->getConnection();

$record = new Records($db);

if(!empty($_POST['action']) && $_POST['action'] == 'addRecord') {
    $record->name = $_POST["name"];
    $record->age = $_POST["age"];
    $record->skills = $_POST["skills"];
    $record->address = $_POST["address"];
    $record->designation = $_POST["designation"];
    $record->addRecord();
}