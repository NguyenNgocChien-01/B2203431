<?php
$serverName = "server_name";
$connectionOptions = array(
    "Database" => "database_name",
    "Uid" => "username",
    "PWD" => "password"
);

$conn = sqlsrv_connect($serverName, $connectionOptions);
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

$query = "SELECT * FROM your_table";
$stmt = sqlsrv_query($conn, $query);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    echo $row['column_name'] . "<br />";
}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>