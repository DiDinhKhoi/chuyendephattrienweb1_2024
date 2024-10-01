<?php
session_start();
require_once 'models/UserModel.php';
$userModel = new UserModel();
$allowed_origin = "http://localhost:8080";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if (!isset($_SERVER['HTTP_REFERER']) || parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) !== parse_url($allowed_origin, PHP_URL_HOST)) {
        die("Yêu cầu không hợp lệ.");
    }
 
    if (!empty($_POST['user_id'])) {
        $id = $_POST['user_id'];
        $userModel->deleteUserById($id); 
    }
    
    header('Location: list_users.php');
    exit(); 
} else {
    
    header('Location: list_users.php');
    exit();
}
?>
