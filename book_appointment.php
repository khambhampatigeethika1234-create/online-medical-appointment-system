<?php
session_start();

if(!isset($_SESSION['email']))
{
    echo "<script>
            alert('Please Login or Register First');
            window.location.href='auth.php';
          </script>";
    exit();
}

$doctor = $_GET['doctor'] ?? '';
?>

<!DOCTYPE html>
<html>
<head>

<title>Book Appointment - Online Medical Appointment System</title>

<style>

body{
    margin:0;
    font-family:Arial,sans-serif;
    background:#f5f9ff;
}

header{
    background:#1976D2;
    color:white;
    text-align:center;
    padding:25px;
}

nav{
    background:#0D47A1;
    padding:15px;
    text-align:center;
}

nav a{
    color:white;
    text-decoration:none;
    margin:15px;
    font-weight:bold;
}

nav a:hover{
    color:#ffeb3b;
}

.container{
    width:450px;
    margin:40px auto;
    background:white;
    padding:30px;
    border-radius:12px;
    box-shadow:0 0 10px lightgray;
}

h2{
    text-align:center;
    color:#1976D2;
}

label{
    font-weight:bold;
    display:block;
    margin-top:15px;
}

input,
select,
textarea{
    width:100%;
    padding:11px;
    margin-top:7px;
    box-sizing:border-box;
    border:1px solid #ccc;
    border-radius:5px;
}

button{
    width:100%;
    padding:12px;
    margin-top:25px;
    background:#1976D2;
    color:white;
    border:none;
    border-radius:5px;
    font-size:16px;
    cursor:pointer;
}

button:hover{
    background:#0D47A1;
}

footer{
    background:#0D47A1;
    color:white;
    text-align:center;
    padding:15px;
    margin-top:40px;
}

</style>

</head>

<body>

<header>
<h1>Online Medical Appointment System</h1>
<p>Your Health, Our Priority</p>
</header>

<nav>

<a href="index.html">Home</a>
<a href="about.html">About</a>
<a href="doctors.html">Doctors</a>
<a href="auth.php">Login/Register</a>
<a href="appointment.php">Appointment</a>
<a href="contact.html">Contact</a>
<a href="logout.php">Logout</a>

</nav>

<div class="container">

<h2>Book Appointment</h2>

<form action="appointment.php" method="POST">

<label>Patient Name</label>
<input type="text" name="name" placeholder="Enter your name" required>

<label>Email</label>
<input type="email" name="email" placeholder="Enter your email" required>

<label>Phone Number</label>
<input type="text" name="phone" placeholder="Enter phone number" required>

<label>Select Doctor</label>

<select name="doctor" required>

<option value="">Select Doctor</option>

<option value="Dr. Rajesh Kumar - Cardiologist"
<?php if(strpos($doctor,"Rajesh") !== false) echo "selected"; ?>>
Dr. Rajesh Kumar - Cardiologist
</option>

<option value="Dr. Priya Sharma - Gynecologist"
<?php if(strpos($doctor,"Priya") !== false) echo "selected"; ?>>
Dr. Priya Sharma - Gynecologist
</option>

<option value="Dr. Arun Kumar - General Physician"
<?php if(strpos($doctor,"Arun") !== false) echo "selected"; ?>>
Dr. Arun Kumar - General Physician
</option>

<option value="Dr. Sneha Reddy - Dermatologist"
<?php if(strpos($doctor,"Sneha") !== false) echo "selected"; ?>>
Dr. Sneha Reddy - Dermatologist
</option>

</select>

<label>Appointment Date</label>
<input type="date" name="date" required>

<label>Appointment Time</label>

<select name="time" required>

<option value="">Select Time</option>
<option value="09:00 AM">09:00 AM</option>
<option value="10:00 AM">10:00 AM</option>
<option value="11:00 AM">11:00 AM</option>
<option value="12:00 PM">12:00 PM</option>
<option value="01:00 PM">01:00 PM</option>
<option value="02:00 PM">02:00 PM</option>
<option value="03:00 PM">03:00 PM</option>
<option value="04:00 PM">04:00 PM</option>
<option value="05:00 PM">05:00 PM</option>
<option value="06:00 PM">06:00 PM</option>

</select>

<label>Message</label>
<textarea name="message"></textarea>

<button type="submit" name="book">
Book Appointment
</button>

</form>

</div>

<footer>
&copy; 2026 Online Medical Appointment System | All Rights Reserved
</footer>

</body>
</html>