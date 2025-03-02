<?php
$db = new SQLite3('database_name.db');

$query = 'SELECT * FROM your_table';
$result = $db->query($query);

while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    echo $row['column_name'] . "<br />";
}

$db->close();
?>