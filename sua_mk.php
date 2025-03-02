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
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2>Sửa mật khẩu</h2>
    <form action="sua_mk.php" method="post">
        <label>Mật khẩu cũ:</label><br>
        <input type="password" id="old_mk" name="old_mk" required><br><br>
        <label >Mật khẩu mới:</label><br>
        <input type="password" id="new_mk" name="new_mk" required><br><br>
        <label >Nhập lại mật khẩu mới:</label><br>
        <input type="password" id="confirm_new_mk" name="confirm_new_mk" required><br><br>
        <input type="submit" name="submit" value="Cập nhật">
    </form>
</body>
</html>

<?php
    if (isset($_POST['submit'])) {
        $old_mk = $_POST['old_mk'];
        $new_mk = $_POST['new_mk'];
        $confirm_new_mk = $_POST['confirm_new_mk'];
       
        $email = $_SESSION['user'];
        // echo $email;
        
        // Kiểm tra mật khẩu cũ
        $sql = "SELECT password FROM customers WHERE email = '$email'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
          //  echo $row['password'] ;
           // echo  md5($old_mk);
            if ($row['password'] != md5($old_mk)) {
                echo "Mật khẩu cũ không đúng!";
            } else {
                // Kiểm tra mật khẩu mới
                if ($new_mk != $confirm_new_mk) {
                    echo "Mật khẩu mới không khớp!";
                } elseif ($new_mk == $old_mk) {
                    echo "Mật khẩu mới không được giống mật khẩu cũ!";
                } else {
                    // Cập nhật mật khẩu mới
                    $new_mk_hashed = md5($new_mk);
                    $sql = "UPDATE customers SET password = '$new_mk_hashed' WHERE email = '$email'";
                    if ($conn->query($sql) === TRUE) {
                        echo "Mật khẩu đã được cập nhật thành công!";
                    } else {
                        echo "Lỗi cập nhật mật khẩu: " . $conn->error;
                    }
                }
            }
        } else {
            echo "Không tìm thấy tài khoản!";
        }
        
        $conn->close();
    }
    ?>