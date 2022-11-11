<?php
include("dataBase.php");

$sql=mysqli_query($conn,"SELECT*FROM customers");
$result=mysqli_fetch_all($sql,MYSQLI_ASSOC);
$output=json_encode($result);


ob_start();

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Content-Type:application/json; charset=UTF-8');
header('x-soft-rev: 2021');

echo $output;
header("Content-length: " . ob_get_length());
ob_end_flush();
