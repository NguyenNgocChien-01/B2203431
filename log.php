

<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlbanhang";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, fullname, email FROM customers WHERE email = '".$_POST["email"]."' AND password = '".md5($_POST["pass"])."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['user'] = $row['email'];
    $_SESSION['fullname'] = $row['fullname'];
    $_SESSION['id'] = $row['id'];
    header('Location: homepage.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    // Tro ve trang dang nhap sau 3 giay
    header('Refresh: 3;url=login.php');
}

$conn->close();
?>