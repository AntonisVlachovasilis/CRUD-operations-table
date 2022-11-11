<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$user_name = $user_surname = $user_phone = $user_mail = $user_category = "";


function test_input($data)
{
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    $data = trim($data);
    return $data;
};

$validation_message = [
    "nameError" => null,
    "surnameError" => null,
    "telephoneError" => null,
    "emailError" => null,
    "categoryError" => null
];
$response_to_call = [
    "result" => null,
    "message" => null,
    "redirect" => null,
    "error" => null
];

function outData($out)
{
    ob_start();

    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST');
    header('Content-Type:application/json; charset=UTF-8');
    header('x-soft-rev: 2021');

    echo $out;
    header("Content-length: " . ob_get_length());
    ob_end_flush();
}





if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (empty($_POST["name"])) {
        $validation_message["nameError"] = "* Παρακαλώ συμπληρώστε το όνομα χρήστη";
    } else {
        $user_name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Zα-ωΑ-Ω]/", $user_name)) {
            $validation_message["nameError"] = "* Το όνομα χρήστη δεν είναι έγκυρο";
        }
    }
    if (empty($_POST["surname"])) {
        $validation_message["surnameError"] = "* Παρακαλώ συμπληρώστε το επώνυμο χρήστη";
    } else {
        $user_surname = test_input($_POST["surname"]);
        if (!preg_match("/^[a-zA-Zα-ωΑ-Ω]/", $user_surname)) {
            $validation_message["surnameError"] = "* Το επώνυμο χρήστη δεν είναι έγκυρο";
        }
    }
    if (empty($_POST["telephone"])) {
        $validation_message["telephoneError"] = "* Παρακαλώ συμπληρώστε το τηλέφωνο επικοινωνίας";
    } else {
        $user_phone = test_input($_POST["telephone"]);
        if (!preg_match("/^\\+?[1-9][0-9]{7,14}$/", $user_phone)) {
            $validation_message["telephoneError"] = "* Το τηλέφωνο επικοινωνίας δεν είναι έγκυρο";
        }
    }
    if (empty($_POST["email"])) {
        $validation_message["emailError"] = "* Παρακαλώ συμπληρώστε το email χρήστη";
    } else {
        $user_mail = test_input($_POST["email"]);
        if (!filter_var($user_mail, FILTER_VALIDATE_EMAIL)) {
            $validation_message["emailError"] = "* Το email δεν ειναι έγκυρο";
        }
    }
    if (empty($_POST["category"])) {
        $validation_message["categoryError"] = "* Παρακαλώ επιλέξτε κατηγορία";
    } else {
        $user_category = $_POST["category"];
    }

    if (is_null($validation_message["nameError"]) && is_null($validation_message["surnameError"]) && is_null($validation_message["telephoneError"]) && is_null($validation_message["emailError"]) && is_null($validation_message["categoryError"])) {

        include("dataBase.php");

        $sql = "INSERT INTO customers (firstname, lastname, telephone, email, category) VALUES ('" . $user_name . "', '" . $user_surname . "', '" . $user_phone . "', '" . $user_mail . "', '" . $user_category . "')";

        if ($conn->query($sql) === TRUE) {
            $response_to_call["result"] = true;
            $response_to_call["message"] = "New record created succesfully";
            $response_to_call["redirect"] = "succesful_submit.html";

            $out = json_encode($response_to_call);
            outData($out);
            $conn->close();
        }
    } else {
        $response_to_call = [
            "result" => false,
            "message" => $validation_message,
            "error" => null
        ];
        $out = json_encode($response_to_call);
        outData($out);
    }
}
