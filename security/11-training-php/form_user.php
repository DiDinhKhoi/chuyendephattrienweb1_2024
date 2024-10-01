<?php
// Bắt đầu phiên
session_start();
require_once 'models/UserModel.php';
$userModel = new UserModel();
$user = NULL; 
$_id = NULL;
if (!empty($_GET['id'])) {
    $_id = intval($_GET['id']); 
    $user = $userModel->findUserById($_id); 
}

if (!empty($_POST['submit'])) {
    try {  
        if (!empty($_POST['id'])) {
            $result = $userModel->updateUser($_POST);
            if ($result) {
                $_SESSION['message'] = 'Cập nhật người dùng thành công!';
                header('location: list_users.php');
                exit(); 
            }
        } else {
            $result = $userModel->insertUser($_POST);
            if ($result) {
                $_SESSION['message'] = 'Thêm người dùng thành công!';
                header('location: list_users.php');
                exit(); 
            }
        }
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>User form</title>
    <?php include 'views/meta.php' ?>
</head>
<body>
    <?php include 'views/header.php' ?>
    <div class="container">
        <?php if (isset($_SESSION['message'])) { ?>
            <div class="alert alert-success" role="alert">
                <?php
                    echo $_SESSION['message'];
                    unset($_SESSION['message']); 
                ?>
            </div>
        <?php } ?>
        <?php if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger" role="alert">
                <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']); 
                ?>
            </div>
        <?php } ?>
        
        <?php if ($user || !isset($_id)) { ?>
            <div class="alert alert-warning" role="alert">
                User form
            </div>
            <form name="userForm" method="POST">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($_id); ?>">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control" name="name" placeholder="Name" value='<?php if (!empty($user[0]['name'])) echo htmlspecialchars($user[0]['name']); ?>'>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>

                <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
            </form>
        <?php } else { ?>
            <div class="alert alert-success" role="alert">
                User not found!
            </div>
        <?php } ?>
    </div>
</body>
</html>

