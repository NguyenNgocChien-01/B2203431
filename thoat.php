<?php
session_start();


$_SESSION = array();

// xóa hoàn toàn session
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// hủy tất cả session
session_destroy();

setcookie("user", "", time() - 1800, "/");
setcookie("fullname", "", time() - 1800, "/");
setcookie("id", "", time() - 1800, "/");

// Chuyển hướng đến trang đăng nhập
header("Location: login.php");
exit;
?>
