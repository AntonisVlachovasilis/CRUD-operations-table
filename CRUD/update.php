<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("dataBase.php");
$id = $_GET["updateid"];
$sql = "SELECT* FROM customers WHERE id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$name = $row["firstname"];
$surname = $row["lastname"];
$phone = $row["telephone"];
$email = $row["email"];
$category = $row["category"];


if (isset($_POST["submit"])) {

    $user_name = $_POST["name"];
    $user_surname = $_POST["surname"];
    $user_phone = $_POST["telephone"];
    $user_email = $_POST["email"];
    $user_category = $_POST["category"];


    $sql = "UPDATE customers SET firstname='$user_name',lastname= '$user_surname',telephone= '$user_phone', email= '$user_email',category='$user_category' WHERE id=$id";

    $result = mysqli_query($conn, $sql);


    if ($result) {
        header("Location:/MyConstructor/formC.html");
    } else {
        die(mysqli_error($conn));
    }
}


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration Update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container my-5 mx-5 px-5">
        <form method="POST" novalidate>
            <div class="mb-3">
                <label class="form-label">Όνομα</label>
                <input type="text" class="form-control" name="name" value=<?= $name ?>>
            </div>
            <div class="mb-3">
                <label class="form-label">Επίθετο</label>
                <input type="text" class="form-control" name="surname" value=<?= $surname ?>>
            </div>
            <div class="mb-3">
                <label class="form-label">Τηλέφωνο</label>
                <input type="phone" class="form-control" name="telephone" value=<?= $phone ?>>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value=<?= $email ?>>
            </div>
            <div class="mb-3">
                <label class="form-label">Κατηγορία</label>
                <input type="text" class="form-control" name="category" value=<?= $category ?>>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Ενημέρωση</button>
        </form>
    </div>

</body>

</html>