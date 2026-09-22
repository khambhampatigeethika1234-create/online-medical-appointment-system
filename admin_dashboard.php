<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.html");
    exit();
}

include "db.php";

// Total Patients
$patient_result = $conn->query("SELECT COUNT(*) AS total FROM patients");
$patient_row = $patient_result->fetch_assoc();
$total_patients = $patient_row['total'];

// Total Doctors
$total_doctors = 4;

// Total Appointments
$appointment_result = $conn->query("SELECT COUNT(*) AS total FROM appointments");
$appointment_row = $appointment_result->fetch_assoc();
$total_appointments = $appointment_row['total'];

// Total Payments
$payment_result = $conn->query("SELECT COUNT(*) AS total FROM payments");
$payment_row = $payment_result->fetch_assoc();
$total_payments = $payment_row['total'];
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">

<title>Admin Dashboard</title>

<style>

*{
    box-sizing:border-box;
}

body{
    margin:0;
    font-family:Arial,sans-serif;
    background:linear-gradient(135deg,#e3f2fd,#f8fbff);
}

/* Header */

header{
    background:linear-gradient(135deg,#0D47A1,#1976D2);
    color:white;
    text-align:center;
    padding:35px 20px;
    box-shadow:0 4px 12px rgba(0,0,0,0.2);
}

header h1{
    margin:0;
    font-size:32px;
}

header p{
    margin-top:10px;
    font-size:18px;
}

/* Main */

.container{
    width:92%;
    max-width:1200px;
    margin:45px auto;
}

/* Welcome */

.welcome{
    background:white;
    padding:25px;
    border-radius:15px;
    box-shadow:0 4px 15px rgba(0,0,0,0.1);
    margin-bottom:35px;
    text-align:center;
}

.welcome h2{
    color:#0D47A1;
    margin:0 0 10px;
    font-size:27px;
}

.welcome p{
    color:#666;
    font-size:17px;
}

/* Cards */

.cards{
    display:flex;
    justify-content:center;
    gap:25px;
    flex-wrap:wrap;
}

.card{
    width:240px;
    min-height:180px;
    padding:30px 20px;
    border-radius:18px;
    text-align:center;
    text-decoration:none;
    color:white;
    box-shadow:0 6px 18px rgba(0,0,0,0.15);
    transition:0.3s;
}

.card:hover{
    transform:translateY(-8px);
    box-shadow:0 10px 25px rgba(0,0,0,0.25);
}

.card h3{
    font-size:22px;
    margin:15px 0;
}

.card p{
    font-size:40px;
    font-weight:bold;
    margin:10px 0;
}

/* Different colors */

.patients{
    background:linear-gradient(135deg,#1565C0,#42A5F5);
}

.doctors{
    background:linear-gradient(135deg,#00897B,#26A69A);
}

.appointments{
    background:linear-gradient(135deg,#6A1B9A,#AB47BC);
}

.payments{
    background:linear-gradient(135deg,#EF6C00,#FFA726);
}

/* Bottom section */

.info{
    margin-top:45px;
    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0 4px 15px rgba(0,0,0,0.1);
    text-align:center;
}

.info h2{
    color:#1976D2;
    margin-top:0;
}

.info p{
    color:#555;
    font-size:16px;
}

/* Logout */

.logout{
    display:inline-block;
    margin-top:25px;
    padding:13px 30px;
    background:#d32f2f;
    color:white;
    text-decoration:none;
    border-radius:8px;
    font-size:16px;
    transition:0.3s;
}

.logout:hover{
    background:#b71c1c;
}

/* Footer */

footer{
    margin-top:50px;
    background:#0D47A1;
    color:white;
    text-align:center;
    padding:20px;
    font-size:14px;
}

</style>

</head>

<body>

<header>

<h1>🏥 Online Medical Appointment System</h1>

<p>Admin Dashboard</p>

</header>


<div class="container">

<div class="welcome">

<h2>Welcome, Admin 👋</h2>

<p>Manage patients, doctors, appointments and payments from one place.</p>

</div>


<div class="cards">


<a href="admin_patients.php" class="card patients">

<h3>👥 Patients</h3>

<p><?php echo $total_patients; ?></p>

</a>


<a href="admin_doctors.php" class="card doctors">

<h3>👨‍⚕️ Doctors</h3>

<p><?php echo $total_doctors; ?></p>

</a>


<a href="admin_appointments.php" class="card appointments">

<h3>📅 Appointments</h3>

<p><?php echo $total_appointments; ?></p>

</a>


<a href="admin_payments.php" class="card payments">

<h3>💳 Payments</h3>

<p>

<?php echo $total_payments; ?></p>

</a>


</div>


<div class="info">

<h2>📊 Admin Control Panel</h2>

<p>
Here you can view patient details, manage doctors,
check appointments and view payment information.
</p>

<a href="admin_logout.php" class="logout">
🚪 Logout
</a>

</div>

</div>


<footer>

© 2026 Online Medical Appointment System | All Rights Reserved

</footer>

</body>

</html>