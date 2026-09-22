<?php

session_start();

include("db.php");

if(!isset($_SESSION['email']))
{
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];

/* Get patient name */

$stmt = $conn->prepare(
    "SELECT fullname FROM patients WHERE email = ?"
);

$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows > 0)
{
    $patient = $result->fetch_assoc();
    $fullname = $patient['fullname'];
}
else
{
    $fullname = "Patient";
}

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Patient Dashboard</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial,sans-serif;
}

body{
    background:#f4f9ff;
    color:#333;
}

/* Header */

header{
    background:linear-gradient(135deg,#0D47A1,#1976D2);
    color:white;
    padding:25px;
    text-align:center;
}

header h1{
    font-size:28px;
    margin-bottom:8px;
}

header p{
    font-size:16px;
}

/* Navigation */

nav{
    background:#023e8a;
    padding:15px;
    text-align:center;
}

nav a{
    color:white;
    text-decoration:none;
    margin:0 15px;
    font-weight:bold;
}

nav a:hover{
    color:#ffd700;
}

/* Welcome */

.welcome{
    width:90%;
    max-width:1100px;
    margin:35px auto 20px;
    background:white;
    padding:25px;
    border-radius:15px;
    box-shadow:0 4px 15px rgba(0,0,0,0.10);
}

.welcome h2{
    color:#0D47A1;
    margin-bottom:10px;
}

.welcome p{
    color:#666;
}

/* Dashboard */

.dashboard{
    width:90%;
    max-width:1100px;
    margin:25px auto 50px;

    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));

    gap:25px;
}

/* Cards */

.card{
    background:white;
    padding:30px 20px;
    border-radius:15px;
    text-align:center;
    box-shadow:0 4px 15px rgba(0,0,0,0.10);

    transition:0.3s;
}

.card:hover{
    transform:translateY(-6px);
    box-shadow:0 8px 20px rgba(0,0,0,0.18);
}

.card h3{
    color:#0D47A1;
    margin-bottom:12px;
    font-size:21px;
}

.card p{
    color:#666;
    font-size:14px;
    line-height:1.5;
    min-height:45px;
}

/* Buttons */

.card a{
    display:inline-block;
    margin-top:18px;
    padding:11px 18px;

    background:#1976D2;
    color:white;

    text-decoration:none;
    border-radius:7px;

    font-weight:bold;
}

.card a:hover{
    background:#0D47A1;
}

/* Logout */

.logout{
    background:#d32f2f !important;
}

.logout:hover{
    background:#b71c1c !important;
}

/* Footer */

footer{
    background:#023e8a;
    color:white;
    text-align:center;
    padding:20px;
    margin-top:30px;
}

/* Mobile */

@media(max-width:600px)
{
    nav a{
        display:block;
        margin:10px;
    }

    .welcome{
        width:92%;
    }

    .dashboard{
        width:92%;
    }
}

</style>

</head>


<body>


<header>

<h1>Online Medical Appointment System</h1>

<p>Patient Dashboard</p>

</header>


<nav>

<a href="index.html">Home</a>

<a href="patient_dashboard.php">Dashboard</a>

<a href="profile.php">My Profile</a>

<a href="logout.php">Logout</a>

</nav>


<div class="welcome">

<h2>
Welcome, <?php echo htmlspecialchars($fullname); ?>!
</h2>

<p>
Manage your profile, appointments and online consultations from your dashboard.
</p>

</div>


<div class="dashboard">


<!-- My Profile -->

<div class="card">

<h3>My Profile</h3>

<p>
View your personal information and account details.
</p>

<a href="profile.php">
View Profile
</a>

</div>


<!-- Edit Profile -->

<div class="card">

<h3>Edit Profile</h3>

<p>
Update your name, phone number and gender.
</p>

<a href="edit_profile.php">
Edit Profile
</a>

</div>


<!-- Change Password -->

<div class="card">

<h3>Change Password</h3>

<p>
Update your account password securely.
</p>

<a href="change_password.php">
Change Password
</a>

</div>


<!-- Book Appointment -->

<div class="card">

<h3>Book Appointment</h3>

<p>
Choose a doctor and book your medical appointment.
</p>

<a href="appointment.html">
Book Now
</a>

</div>


<!-- My Appointments -->

<div class="card">

<h3>My Appointments</h3>

<p>
View your booked appointments and their current status.
</p>

<a href="my_appointments.php">
View Appointments
</a>

</div>


<!-- Video Consultation -->

<div class="card">

<h3>Video Consultation</h3>

<p>
Book an online video consultation with a doctor.
</p>

<a href="video.html">
Start Consultation
</a>

</div>


<!-- Chat -->

<div class="card">

<h3>Chat With Us</h3>

<p>
Send messages and communicate with the medical support team.
</p>

<a href="chat.html">
Open Chat
</a>

</div>


<!-- Logout -->

<div class="card">

<h3>Logout</h3>

<p>
Logout from your patient account safely.
</p>

<a href="logout.php" class="logout">
Logout
</a>

</div>


</div>


<footer>

© 2026 Online Medical Appointment System | All Rights Reserved

</footer>


</body>

</html>