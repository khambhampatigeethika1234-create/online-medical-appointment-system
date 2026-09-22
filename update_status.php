<?php

session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: admin_login.html");
    exit();
}

include "db.php";

$id = $_POST['id'] ?? '';
$status = $_POST['status'] ?? '';

if($id != '' && $status != '')
{
    $query = "UPDATE appointments SET status='$status' WHERE id='$id'";

    mysqli_query($conn, $query);
}

header("Location: admin_appointments.php");
exit();

?>