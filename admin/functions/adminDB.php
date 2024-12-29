<?php

// Database Connection Setup
$db1 = [
    "db_host" => "localhost",
    "db_user" => "root",
    "db_pass" => "",
    "db_name" => "uniq_admin"
];

foreach ($db1 as $key => $value) {
    define(strtoupper($key), $value);
}

$connection1 = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (!$connection1) {
    die("Connection to first database failed: " . mysqli_connect_error());
}

$db2 = [
    "db_host" => "localhost",
    "db_user" => "root",
    "db_pass" => "",
    "db_name" => "uniq"
];

foreach ($db2 as $key => $value) {
    define(strtoupper("SECOND_" . $key), $value);
}

$connection2 = mysqli_connect(SECOND_DB_HOST, SECOND_DB_USER, SECOND_DB_PASS, SECOND_DB_NAME);
if (!$connection2) {
    die("Connection to second database failed: " . mysqli_connect_error());
} ?>