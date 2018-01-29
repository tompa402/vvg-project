<?php

$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_passwd'] = "";
$db['db_name'] = "vvg-project";

foreach ($db as $key => $value) {
    define(strtoupper($key), $value);
}

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWD, DB_NAME);

if (!$conn) {
    die('Database connection failed');
}
?>
