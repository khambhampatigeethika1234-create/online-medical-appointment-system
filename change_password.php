<?php

session_start();

include("db.php");

if(!isset($_SESSION['email']))
{
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];

$message = "";
$message_type = "";

if(isset($_POST['change_password']))
{
    $current_password = $_POST['current_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if($current_password == '' || $new_password == '' || $confirm_password == '')
    {
        $message = "Please fill all fields.";
        $message_type = "error";
    }
    elseif($new_password != $confirm_password)
    {
        $message = "New password and confirm password do not match.";
        $message_type = "error";
    }
    elseif(strlen($new_password) < 6)
    {
        $message = "New password must contain at least 6 characters.";
        $message_type = "error";
    }
    else
    {
        /* Check current password */

        $stmt = $conn->prepare(
            "SELECT password FROM patients WHERE email = ?"
        );

        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows > 0)
        {
            $patient = $result->fetch_assoc();

            if($patient['password'] == $current_password)
            {
                /* Update password */

                $update = $conn->prepare(
                    "UPDATE patients SET password = ? WHERE email = ?"
                );

                $update->bind_param(
                    "ss",
                    $new_password,
                    $email
                );

                if($update->execute())
                {
                    $message = "Password changed successfully!";
                    $message_type = "success";
                }
                else
                {
                    $message = "Unable to change password.";
                    $message_type = "error";
                }
            }
            else
            {
                $message = "Current password is incorrect.";
                $message_type = "error";
            }
        }
        else
        {
            $message = "Patient account not found.";
            $message_type = "error";
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Change Password</title>

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
    padding:25px;
}

header h1{
    margin:0;
    font-size:28px;
}

header p{
    margin:8px 0 0;
}

/* Container */

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

/* Account */

.account{
    background:#f1f7ff;
    padding:12px;
    border-radius:7px;
    margin-bottom:20px;
    text-align:center;
    color:#555;
}

/* Form */

label{
    display:block;
    font-weight:bold;
    color:#444;
    margin-top:15px;
    margin-bottom:7px;
}

input{
    width:100%;
    padding:12px;
    border:1px solid #ccc;
    border-radius:7px;
    font-size:15px;
}

input:focus{
    outline:none;
    border-color:#1976D2;
}

/* Button */

button{
    width:100%;
    padding:13px;
    margin-top:25px;
    background:#1976D2;
    color:white;
    border:none;
    border-radius:7px;
    font-size:16px;
    font-weight:bold;
    cursor:pointer;
}

button:hover{
    background:#0D47A1;
}

/* Messages */

.success{
    background:#e8f5e9;
    color:#218838;
    padding:12px;
    border-radius:7px;
    text-align:center;
    margin-bottom:20px;
}

.error{
    background:#ffebee;
    color:#c62828;
    padding:12px;
    border-radius:7px;
    text-align:center;
    margin-bottom:20px;
}

/* Links */

.links{
    text-align:center;
    margin-top:20px;
}

.links a{
    display:inline-block;
    text-decoration:none;
    background:#555;
    color:white;
    padding:10px 18px;
    border-radius:6px;
    margin:5px;
}

.links a:hover{
    background:#333;
}

.profile{
    background:#1976D2 !important;
}

.profile:hover{
    background:#0D47A1 !important;
}

</style>

</head>

<body>

<header>

<h1>Online Medical Appointment System</h1>

<p>Change Password</p>

</header>


<div class="container">

<h2>Change Password</h2>


<div class="account">

Logged in as:
<b><?php echo htmlspecialchars($email); ?></b>

</div>


<?php

if($message != "")
{
?>

<div class="<?php echo $message_type; ?>">

<?php echo htmlspecialchars($message); ?>

</div>

<?php
}

?>


<form method="POST">


<label>Current Password</label>

<input
type="password"
name="current_password"
placeholder="Enter current password"
required
>


<label>New Password</label>

<input
type="password"
name="new_password"
placeholder="Enter new password"
required
>


<label>Confirm New Password</label>

<input
type="password"
name="confirm_password"
placeholder="Confirm new password"
required
>


<button type="submit" name="change_password">

Change Password

</button>


</form>


<div class="links">

<a href="profile.php" class="profile">
My Profile
</a>

<a href="index.html">
Back to Home
</a>

</div>


</div>

</body>

</html>