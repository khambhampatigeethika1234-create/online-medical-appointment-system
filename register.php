<?php
include("db.php");

if(isset($_POST['register']))
{
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];

    $sql = "INSERT INTO patients(fullname,email,phone,gender,password)
            VALUES('$fullname','$email','$phone','$gender','$password')";

    if($conn->query($sql)==TRUE)
{
    echo "<script>
            alert('Registration Successful');
            window.location.href='index.html';
          </script>";
}
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register - Online Medical Appointment System</title>

    <style>
        body{
            margin:0;
            font-family:Arial,sans-serif;
            background:#f4f8fc;
        }

        header{
            background:#2196F3;
            color:white;
            text-align:center;
            padding:20px;
        }

        nav{
            background:#0D47A1;
            padding:15px;
            text-align:center;
        }

        nav a{
            color:white;
            text-decoration:none;
            margin:20px;
            font-weight:bold;
        }

        nav a:hover{
            color:yellow;
        }

        .container{
            width:400px;
            margin:40px auto;
            background:white;
            padding:25px;
            border-radius:10px;
            box-shadow:0 0 10px lightgray;
        }

        h2{
            text-align:center;
            color:#1976D2;
        }

        label{
            font-weight:bold;
        }

        input,select{
            width:100%;
            padding:10px;
            margin:8px 0 15px;
            border:1px solid #ccc;
            border-radius:5px;
        }

        button{
            width:100%;
            background:#1976D2;
            color:white;
            padding:12px;
            border:none;
            border-radius:5px;
            font-size:16px;
            cursor:pointer;
        }

        button:hover{
            background:#0D47A1;
        }

        p{
            text-align:center;
        }

        footer{
            background:#0D47A1;
            color:white;
            text-align:center;
            padding:15px;
            margin-top:30px;
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
<a href="login.php">Login</a>
<a href="register.php">Register</a>
<a href="appointment.php">Appointment</a>
<a href="contact.html">Contact</a>
</nav>

<div class="container">

<h2>Patient Registration</h2>

<form method="POST" action="">

<label>Full Name</label>
<input type="text" name="fullname" placeholder="Enter your full name" required>

<label>Email</label>
<input type="email" name="email" placeholder="Enter your email" required>

<label>Phone Number</label>
<input type="tel" name="phone" placeholder="Enter your phone number" required>

<label>Gender</label>
<select name="gender" required>
<option value="">Select Gender</option>
<option>Male</option>
<option>Female</option>
<option>Other</option>
</select>

<label>Password</label>
<input type="password" name="password" required>

<label>Confirm Password</label>
<input type="password" name="confrim_password" required>

<button type="submit" name="register">Register</button>

</form>

<p>Already have an account? <a href="login.html">Login</a></p>

</div>

<footer>
© 2026 Online Medical Appointment System | All Rights Reserved
</footer>

</body>
</html>