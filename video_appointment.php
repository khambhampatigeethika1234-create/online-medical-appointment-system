<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $doctor = trim($_POST['doctor'] ?? '');
    $date = trim($_POST['date'] ?? '');
    $time = trim($_POST['time'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Basic validation
    if ($name == '' || $email == '' || $phone == '' || 
        $doctor == '' || $date == '' || $time == '')
    {
        echo "<script>
                alert('Please fill all required details.');
                window.history.back();
              </script>";
        exit();
    }

    // Store patient details
    $_SESSION['patient_name'] = $name;
    $_SESSION['patient_email'] = $email;
    $_SESSION['patient_phone'] = $phone;

    // Store appointment details
    $_SESSION['email'] = $email;
    $_SESSION['doctor'] = $doctor;
    $_SESSION['appointment_date'] = $date;
    $_SESSION['appointment_time'] = $time;
    $_SESSION['appointment_message'] = $message;

    // Mark as video appointment
    $_SESSION['video_appointment'] = true;

    // Generate appointment ID
    $_SESSION['appointment_id'] = "VID" . rand(10000, 99999);

    // Go to payment
    header("Location: payment.php");
    exit();
}
else
{
    header("Location: video_appointment.html");
    exit();
}

?>