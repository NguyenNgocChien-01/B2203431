<?php
$conn = oci_connect('username', 'password', 'hostname/service_name');
if (!$conn) {
    $e = oci_error();
    echo "Kết nối không thành công: " . $e['message'];
    exit;
}

$query = 'SELECT * FROM your_table';
$stid = oci_parse($conn, $query);
oci_execute($stid);

while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
        echo ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . " ";
    }
    echo "<br>\n";
}

oci_free_statement($stid);
oci_close($conn);
?>