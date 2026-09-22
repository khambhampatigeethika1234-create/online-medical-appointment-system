<?php
session_start();

$patient_name = $_SESSION['patient_name'] ?? '';
$doctor = $_SESSION['doctor'] ?? '';
$appointment_date = $_SESSION['appointment_date'] ?? '';
$appointment_time = $_SESSION['appointment_time'] ?? '';

$appointment_id = $_SESSION['appointment_id'] ?? 'APT' . rand(10000,99999);
$payment_method = $_SESSION['payment_method'] ?? 'UPI Payment';
$payment_amount = $_SESSION['payment_amount'] ?? 500;
$payment_status = $_SESSION['payment_status'] ?? 'Paid';

$video_appointment = $_SESSION['video_appointment'] ?? false;

$consultation_type = $video_appointment
    ? 'Video Consultation'
    : 'Doctor Appointment';
?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Payment Receipt</title>

<style>

body{
    font-family:Arial,sans-serif;
    background:#f5f9ff;
    margin:0;
    color:#333;
}

header{
    background:#1976D2;
    color:white;
    text-align:center;
    padding:20px;
}

header h1{
    margin:0;
    font-size:26px;
}

header p{
    margin:6px 0 0;
}

.container{
    width:550px;
    max-width:90%;
    margin:35px auto;
    background:white;
    padding:30px;
    border-radius:12px;
    box-shadow:0 4px 15px rgba(0,0,0,0.12);
}

.success{
    text-align:center;
    color:#218838;
    font-size:24px;
    font-weight:bold;
}

.success-icon{
    font-size:40px;
}

.subtitle{
    text-align:center;
    color:#666;
    margin-bottom:25px;
}

.receipt-box{
    border:1px solid #ddd;
    border-radius:10px;
    overflow:hidden;
}

.receipt-title{
    background:#1976D2;
    color:white;
    padding:14px;
    text-align:center;
    font-size:20px;
    font-weight:bold;
}

.row{
    display:flex;
    justify-content:space-between;
    padding:13px 16px;
    border-bottom:1px solid #eee;
}

.row:last-child{
    border-bottom:none;
}

.label{
    font-weight:bold;
    color:#555;
}

.value{
    text-align:right;
    color:#222;
}

.amount{
    background:#e8f5e9;
    padding:18px;
    margin-top:20px;
    border-radius:8px;
    text-align:center;
}

.amount p{
    margin:5px;
}

.amount h2{
    margin:8px;
    color:#218838;
}

.paid{
    color:#218838;
    font-weight:bold;
}

.buttons{
    text-align:center;
    margin-top:25px;
}

.button{
    display:inline-block;
    background:#1976D2;
    color:white;
    padding:12px 20px;
    text-decoration:none;
    border-radius:6px;
    margin:5px;
    border:none;
    cursor:pointer;
    font-size:15px;
}

.button:hover{
    background:#0D47A1;
}

.home{
    background:#555;
}

.home:hover{
    background:#333;
}

.note{
    text-align:center;
    color:#777;
    font-size:13px;
    margin-top:20px;
}

@media print{

    body{
        background:white;
    }

    header{
        background:white;
        color:black;
        border-bottom:1px solid #ddd;
    }

    .container{
        width:90%;
        box-shadow:none;
        margin:auto;
    }

    .buttons{
        display:none;
    }

}

</style>

</head>

<body>

<header>

<h1>Online Medical Appointment System</h1>

<p>Your Health, Our Priority</p>

</header>


<div class="container">

<div class="success">

<div class="success-icon">✓</div>

Payment Successful

</div>

<p class="subtitle">
Your appointment has been successfully confirmed.
</p>


<div class="receipt-box">

<div class="receipt-title">
Appointment Receipt
</div>


<div class="row">

<span class="label">
Appointment ID
</span>

<span class="value">
<?php echo htmlspecialchars($appointment_id); ?>
</span>

</div>


<div class="row">

<span class="label">
Patient Name
</span>

<span class="value">
<?php echo htmlspecialchars($patient_name); ?>
</span>

</div>


<div class="row">

<span class="label">
Doctor
</span>

<span class="value">
<?php echo htmlspecialchars($doctor); ?>
</span>

</div>


<div class="row">

<span class="label">
Appointment Date
</span>

<span class="value">
<?php echo htmlspecialchars($appointment_date); ?>
</span>

</div>


<div class="row">

<span class="label">
Appointment Time
</span>

<span class="value">
<?php echo htmlspecialchars($appointment_time); ?>
</span>

</div>


<div class="row">

<span class="label">
Consultation Type
</span>

<span class="value">
<?php echo htmlspecialchars($consultation_type); ?>
</span>

</div>


<div class="row">

<span class="label">
Payment Method
</span>

<span class="value">
<?php echo htmlspecialchars($payment_method); ?>
</span>

</div>


<div class="row">

<span class="label">
Payment Status
</span>

<span class="value paid">
<?php echo htmlspecialchars($payment_status); ?>
</span>

</div>

</div>


<div class="amount">

<p>Consultation Fee</p>

<h2>
₹<?php echo htmlspecialchars($payment_amount); ?>
</h2>

<p class="paid">
Payment Completed
</p>

</div>


<div class="buttons">

<button
class="button"
onclick="window.print()">

Print Receipt

</button>


<a
href="index.html"
class="button home">

Back to Home

</a>

</div>


<p class="note">

Thank you for using Online Medical Appointment System.

</p>

</div>

</body>

</html>