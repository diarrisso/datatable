<?php
require_once __DIR__ . '/config/Database.php';
$db = new Database();
$conn = $db->getConnection();
if (!$conn) {
    die('Connection failed: ');
}
$id = $_POST['id'];
$sql = "DELETE FROM Blog.carrier  WHERE id='".$id."' ";
$stmt = $conn->prepare($sql);
$stmt->execute();
if ($stmt->execute()) {
echo json_encode(array('statusCode'=>200));
}
else {
echo json_encode(array('statusCode'=>201));
}

?>