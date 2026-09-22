<?php
session_start();

include("db.php");

if(!isset($_SESSION['email']))
{
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];

$stmt = $conn->prepare("SELECT fullname, email, phone, gender FROM patients WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows > 0)
{
    $patient = $result->fetch_assoc();
}
else
{
    echo "Patient details not found.";
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>My Profile</title>

<style>

body{
    margin:0;
    font-family:Arial,sans-serif;
    background:linear-gradient(135deg,#e3f2fd,#f8fbff);
}

header{
    background:linear-gradient(135deg,#0D47A1,#1976D2);
    color:white;
    text-align:center;
    padding:25px;
}

header h1{
    margin:0;
}

.container{
    width:450px;
    max-width:90%;
    margin:45px auto;
    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0 5px 20px rgba(0,0,0,0.15);
}

h2{
    text-align:center;
    color:#0D47A1;
    margin-bottom:25px;
}

.profile-box{
    background:#f5f9ff;
    border-radius:10px;
    padding:20px;
}

.row{
    display:flex;
    justify-content:space-between;
    padding:14px 5px;
    border-bottom:1px solid #ddd;
}

.row:last-child{
    border-bottom:none;
}

.label{
    font-weight:bold;
    color:#555;
}

.value{
    color:#222;
    text-align:right;
}

.button-box{
    text-align:center;
    margin-top:25px;
}

.button{
    display:inline-block;
    padding:12px 20px;
    background:#1976D2;
    color:white;
    text-decoration:none;
    border-radius:7px;
    margin:5px;
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

</style>

</head>

<body>

<header>

<h1>Online Medical Appointment System</h1>

<p>My Profile</p>

</header>


<div class="container">

<h2>Patient Profile</h2>

<div class="profile-box">

<div class="row">

<span class="label">Full Name</span>

<span class="value">
<?php echo htmlspecialchars($patient['fullname']); ?>
</span>

</div>


<div class="row">

<span class="label">Email</span>

<span class="value">
<?php echo htmlspecialchars($patient['email']); ?>
</span>

</div>


<div class="row">

<span class="label">Phone</span>

<span class="value">
<?php echo htmlspecialchars($patient['phone']); ?>
</span>

</div>


<div class="row">

<span class="label">Gender</span>

<span class="value">
<?php echo htmlspecialchars($patient['gender']); ?>
</span>

</div>

</div>


<div class="button-box">

<a href="my_appointments.php" class="button">
My Appointments
</a>

<a href="index.html" class="button home">
Back to Home
</a>

</div>

</div>

</body>

</html>