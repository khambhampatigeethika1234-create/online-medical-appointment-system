<?php
include("db.php");
session_start();

if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM patients WHERE email='$email' AND password='$password'";

    $result = $conn->query($sql);

    if($result->num_rows > 0)
    {
        $_SESSION['email'] = $email;

        header("Location:index.html");
        exit();
    }
    else
    {
        $error = "Invalid Email or Password";
    }
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Patient Login</title>

<style>

body{
    font-family: Arial;
    background:#f2f2f2;
}

.login-box{
    width:350px;
    margin:80px auto;
    background:white;
    padding:25px;
    border-radius:10px;
    box-shadow:0px 0px 10px gray;
}

h2{
    text-align:center;
    color:#007bff;
}

input{
    width:100%;
    padding:10px;
    margin:10px 0;
}

button{
    width:100%;
    padding:10px;
    background:#007bff;
    color:white;
    border:none;
    border-radius:5px;
    cursor:pointer;
}

button:hover{
    background:#0056b3;
}

p{
    text-align:center;
    color:red;
}

</style>

</head>

<body>


<div class="login-box">

<h2>Patient Login</h2>


<?php

if(isset($error))
{
    echo "<p>".$error."</p>";
}

?>


<form method="POST">


<label>Email</label>

<input type="email" name="email" required>


<label>Password</label>

<input type="password" name="password" required>


<button type="submit" name="login">
Login
</button>


</form>


</div>


</body>
</html>