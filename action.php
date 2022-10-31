<?php
require_once __DIR__. "/class/Employee.php";
require_once __DIR__ . '/lib/ExportService.php';
require_once __DIR__ . '/lib/Post.php';
//  include('Employee.php');
/*$emp = new Employee();
if (!empty($_POST['action']) && $_POST['action'] == 'listEmployee') {
    $emp->employeeList();
}
if (!empty($_POST['action']) && $_POST['action'] == 'addEmployee') {
    $emp->addEmployee();
}
if (!empty($_POST['action']) && $_POST['action'] == 'getEmployee') {
    $emp->getEmployee();
}
if (!empty($_POST['action']) && $_POST['action'] == 'updateEmployee') {
    $emp->updateEmployee();
}
if (!empty($_POST['action']) && $_POST['action'] == 'empDelete') {
    $emp->deleteEmployee();
}*/

/*if (isset($_POST['action']) && $_POST['action'] === 'import') {

        $getAllPost = new Post();
        $allPost = $getAllPost->getAllPost();
        $tester = new ExportService();
        try {
            $tester->exportExcel($allPost);
        } catch (\PhpOffice\PhpSpreadsheet\Writer\Exception|\PhpOffice\PhpSpreadsheet\Exception $e) {
            error_log('$message' . $e);
        }
}*/


