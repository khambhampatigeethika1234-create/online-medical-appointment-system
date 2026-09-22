<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Login / Register</title>

<style>
body{
    font-family:Arial,sans-serif;
    background:#f4f8fc;
    margin:0;
}

header{
    background:#1976D2;
    color:white;
    text-align:center;
    padding:20px;
}

.container{
    display:flex;
    justify-content:center;
    gap:30px;
    margin:40px;
    flex-wrap:wrap;
}

.box{
    width:350px;
    background:white;
    padding:20px;
    border-radius:10px;
    box-shadow:0 0 10px lightgray;
    text-align:center;
}

.button{
    display:inline-block;
    margin-top:20px;
    padding:12px 25px;
    background:#1976D2;
    color:white;
    text-decoration:none;
    border-radius:5px;
}

.button:hover{
    background:#0D47A1;
}
</style>
</head>

<body>

<header>
<h1>Online Medical Appointment System</h1>
<p>Login or Register to Continue</p>
</header>

<div class="container">

<div class="box">
<h2>Existing User</h2>
<p>If you already have an account, login here.</p>

<a href="login.php" class="button">Login</a>
</div>

<div class="box">
<h2>New User</h2>
<p>Create a new account before booking an appointment.</p>

<a href="register.php" class="button">Register</a>
</div>

</div>

</body>
</html>