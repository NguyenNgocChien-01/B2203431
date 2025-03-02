<?php
session_start();

// Kết nối tới cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlbanhang";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST["submit"])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

 
    if($fileType != "csv") {
        echo "Chỉ chấp nhận file CSV .";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Upload thất bại";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename($_FILES["fileToUpload"]["name"]). " Đã được upload<br>";
           
            if (($handle = fopen($target_file, "r")) !== FALSE) {
                fgetcsv($handle);
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $id = $data[0];
                    $fullname = $data[1];
                    $email = $data[2];
                    $password = md5($data[3]);
                    $img_profile = $data[4];

                    $sql = "INSERT INTO customers (id, fullname, email, password, img_profile) VALUES ('$id', '$fullname', '$email', '$password', '$img_profile')";

                    if ($conn->query($sql) === TRUE) {
                        echo "Đã cập nhật thành công<br>";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
                fclose($handle);
            }
        } else {
            echo "Xin lỗi, chưa có file nào được chọn.";
        }
    }
}

$conn->close();
?>
