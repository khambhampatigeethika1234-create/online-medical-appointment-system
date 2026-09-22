<?php

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$doctor = $_POST['doctor'] ?? '';
$time = $_POST['time'] ?? '';
$date = $_POST['date'] ?? '';
$message = $_POST['message'] ?? '';

$_SESSION['patient_name'] = $name;
$_SESSION['patient_email'] = $email;
$_SESSION['patient_phone'] = $phone;
$_SESSION['doctor'] = $doctor;
$_SESSION['appointment_date'] = $date;
$_SESSION['appointment_time'] = $time;
$_SESSION['appointment_message'] = $message;

    // Payment page ki velladam
    header("Location: payment.php");
    exit();
}
else
{
    header("Location: appointment.html");
    exit();
}

?>