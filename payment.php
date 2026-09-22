<?php

session_start();

include("db.php");

$patient_name = $_SESSION['patient_name'] ?? '';
$doctor = $_SESSION['doctor'] ?? '';
$appointment_date = $_SESSION['appointment_date'] ?? '';
$appointment_time = $_SESSION['appointment_time'] ?? '';
$appointment_id = $_SESSION['appointment_id'] ?? ('APT' . rand(10000, 99999));

if(isset($_POST['pay']))
{
    $amount = 500;
    $payment_method = $_POST['payment_method'] ?? 'UPI Payment';
    $payment_status = "Paid";

    $stmt = $conn->prepare(
        "INSERT INTO payments
        (patient_name, doctor, appointment_date, appointment_time, amount, payment_method, payment_status)
        VALUES (?, ?, ?, ?, ?, ?, ?)"
    );

    $stmt->bind_param(
        "ssssdss",
        $patient_name,
        $doctor,
        $appointment_date,
        $appointment_time,
        $amount,
        $payment_method,
        $payment_status
    );

    if($stmt->execute())
    {
        $_SESSION['payment_method'] = $payment_method;
        $_SESSION['payment_amount'] = $amount;
        $_SESSION['payment_status'] = $payment_status;
        $_SESSION['appointment_id'] = $appointment_id;

        echo "<script>
                alert('Payment Successful!');
                window.location.href='receipt.php';
              </script>";
        exit();
    }
    else
    {
        echo "Payment Error: " . $stmt->error;
    }
}

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Online Payment - Medical Appointment</title>

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
    width:460px;
    max-width:90%;
    margin:35px auto;
    background:white;
    padding:30px;
    border-radius:12px;
    box-shadow:0 4px 15px rgba(0,0,0,0.12);
}

h2{
    text-align:center;
    color:#1976D2;
    margin-top:0;
}

.subtitle{
    text-align:center;
    color:#666;
    margin-bottom:25px;
}

.details{
    background:#f1f7ff;
    padding:18px;
    border-radius:10px;
    margin-bottom:22px;
    border-left:4px solid #1976D2;
}

.details p{
    margin:10px 0;
}

.fee{
    background:#e8f5e9;
    padding:15px;
    border-radius:8px;
    text-align:center;
    margin-bottom:22px;
}

.fee h3{
    margin:0;
    color:#218838;
}

.method-title{
    color:#1976D2;
    margin-bottom:12px;
}

.payment-option{
    display:block;
    background:#fafafa;
    border:1px solid #ddd;
    padding:14px;
    margin:10px 0;
    border-radius:8px;
    cursor:pointer;
}

.payment-option:hover{
    border-color:#1976D2;
    background:#f5f9ff;
}

.payment-option input{
    margin-right:10px;
}

.payment-box{
    display:none;
    background:#f8fbff;
    border:1px solid #d8e8f8;
    padding:15px;
    border-radius:8px;
    margin-top:12px;
    text-align:center;
}

.payment-box p{
    margin:7px 0;
}

.demo-note{
    font-size:13px;
    color:#666;
}

.qr-image{
    width:180px;
    height:180px;
    object-fit:contain;
    margin:10px auto;
    display:block;
}

.pay-button{
    width:100%;
    padding:14px;
    margin-top:22px;
    background:#28a745;
    color:white;
    border:none;
    border-radius:7px;
    font-size:17px;
    font-weight:bold;
    cursor:pointer;
}

.pay-button:hover{
    background:#218838;
}

.security{
    text-align:center;
    margin-top:18px;
    font-size:13px;
    color:#777;
}

</style>

<script>

function showPaymentBox(method)
{
    document.getElementById("cardBox").style.display = "none";
    document.getElementById("upiBox").style.display = "none";
    document.getElementById("qrBox").style.display = "none";

    if(method === "Card Payment")
    {
        document.getElementById("cardBox").style.display = "block";
    }

    if(method === "UPI Payment")
    {
        document.getElementById("upiBox").style.display = "block";
    }

    if(method === "Scan QR Code")
    {
        document.getElementById("qrBox").style.display = "block";
    }
}

</script>

</head>

<body>

<header>

<h1>Online Medical Appointment System</h1>

<p>Secure Payment</p>

</header>

<div class="container">

<h2>Online Payment</h2>

<p class="subtitle">
Complete your payment to confirm your appointment
</p>

<div class="details">

<p>
<b>Appointment ID:</b>
<?php echo htmlspecialchars($appointment_id); ?>
</p>

<p>
<b>Patient Name:</b>
<?php echo htmlspecialchars($patient_name); ?>
</p>

<p>
<b>Doctor:</b>
<?php echo htmlspecialchars($doctor); ?>
</p>

<p>
<b>Appointment Date:</b>
<?php echo htmlspecialchars($appointment_date); ?>
</p>

<p>
<b>Appointment Time:</b>
<?php echo htmlspecialchars($appointment_time); ?>
</p>

</div>

<div class="fee">

<h3>Consultation Fee: ₹500</h3>

</div>

<h3 class="method-title">
Choose Payment Method
</h3>

<form method="POST">

<label class="payment-option">

<input
type="radio"
name="payment_method"
value="Card Payment"
onclick="showPaymentBox('Card Payment')"
checked>

<b>Card Payment</b>

<br>

<span class="demo-note">
Pay securely using card payment
</span>

</label>


<label class="payment-option">

<input
type="radio"
name="payment_method"
value="UPI Payment"
onclick="showPaymentBox('UPI Payment')">

<b>UPI Payment</b>

<br>

<span class="demo-note">
PhonePe / Google Pay / Paytm
</span>

</label>


<label class="payment-option">

<input
type="radio"
name="payment_method"
value="Scan QR Code"
onclick="showPaymentBox('Scan QR Code')">

<b>Scan QR Code</b>

<br>

<span class="demo-note">
Scan the QR code using a UPI app
</span>

</label>


<div id="cardBox" class="payment-box">

<h3>Card Payment</h3>

<p>Card payment option selected.</p>

<p class="demo-note">
This is a project demonstration payment.
No real card details are required.
</p>

</div>


<div id="upiBox" class="payment-box">

<h3>UPI Payment</h3>

<p>UPI payment option selected.</p>

<p class="demo-note">
This is a project demonstration payment.
No real UPI credentials are required.
</p>

</div>


<div id="qrBox" class="payment-box">

<h3>Scan QR Code</h3>

<img
src="images/qr.png"
class="qr-image"
alt="UPI QR Code">

<p>
Scan using a UPI app
</p>

<p class="demo-note">
Demo QR payment for project presentation
</p>

</div>


<button
type="submit"
name="pay"
class="pay-button">

Proceed to Payment ₹500

</button>

</form>

<div class="security">

Payment simulation for Online Medical Appointment System

</div>

</div>

<script>

// Show default Card Payment box
showPaymentBox('Card Payment');

</script>

</body>

</html>