<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("dataBase.php");

if (isset($_GET["deleteid"])) {
    $id = $_GET["deleteid"];

    $sql = "DELETE FROM customers WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location:/MyConstructor/formC.html");
    } else {
        die(mysqli_error($conn));
    }
}
