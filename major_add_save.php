<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlsv";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

    $sql = "INSERT INTO major (id, name_major) VALUES 
        (NULL,'".$_POST["name_major"] ."')";

if ($conn->query($sql) == TRUE) {
    echo "Them major thanh cong";

    // chuyen den major_index.php
    header('Location: major_index.php');
} else {
    echo "Lỗi: " . $sql . "<br>" . $conn->error;
}
    $conn->close();
?>