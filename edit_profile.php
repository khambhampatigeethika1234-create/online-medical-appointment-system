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

/* Get current patient details */

$stmt = $conn->prepare(
    "SELECT fullname, email, phone, gender
     FROM patients
     WHERE email = ?"
);

$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows == 0)
{
    echo "Patient details not found.";
    exit();
}

$patient = $result->fetch_assoc();


/* Update profile */

if(isset($_POST['update_profile']))
{
    $fullname = trim($_POST['fullname'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $gender = trim($_POST['gender'] ?? '');

    if($fullname == '' || $phone == '' || $gender == '')
    {
        $message = "Please fill all fields.";
        $message_type = "error";
    }
    else
    {
        $update = $conn->prepare(
            "UPDATE patients
             SET fullname = ?, phone = ?, gender = ?
             WHERE email = ?"
        );

        $update->bind_param(
            "ssss",
            $fullname,
            $phone,
            $gender,
            $email
        );

        if($update->execute())
        {
            $message = "Profile updated successfully!";
            $message_type = "success";

            /* Update displayed values */

            $patient['fullname'] = $fullname;
            $patient['phone'] = $phone;
            $patient['gender'] = $gender;
        }
        else
        {
            $message = "Unable to update profile.";
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

<title>Edit Profile</title>

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
    font-size:16px;
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

/* Form */

label{
    display:block;
    font-weight:bold;
    color:#444;
    margin-top:15px;
    margin-bottom:7px;
}

input,
select{
    width:100%;
    padding:12px;
    border:1px solid #ccc;
    border-radius:7px;
    font-size:15px;
}

input:focus,
select:focus{
    outline:none;
    border-color:#1976D2;
}

/* Email */

.email-box{
    background:#f1f7ff;
    padding:12px;
    border-radius:7px;
    color:#555;
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

/* Back links */

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

.profile-link{
    background:#1976D2 !important;
}

.profile-link:hover{
    background:#0D47A1 !important;
}

</style>

</head>

<body>

<header>

<h1>Online Medical Appointment System</h1>

<p>Edit My Profile</p>

</header>


<div class="container">

<h2>Edit Profile</h2>


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


<label>Full Name</label>

<input
type="text"
name="fullname"
value="<?php echo htmlspecialchars($patient['fullname']); ?>"
required
>


<label>Email</label>

<div class="email-box">

<?php echo htmlspecialchars($patient['email']); ?>

</div>


<label>Phone Number</label>

<input
type="text"
name="phone"
value="<?php echo htmlspecialchars($patient['phone']); ?>"
required
>


<label>Gender</label>

<select name="gender" required>

<option value="">Select Gender</option>

<option value="Male"
<?php
if($patient['gender'] == "Male")
{
    echo "selected";
}
?>
>
Male
</option>

<option value="Female"
<?php
if($patient['gender'] == "Female")
{
    echo "selected";
}
?>
>
Female
</option>

<option value="Other"
<?php
if($patient['gender'] == "Other")
{
    echo "selected";
}
?>
>
Other
</option>

</select>


<button type="submit" name="update_profile">

Update Profile

</button>


</form>


<div class="links">

<a href="profile.php" class="profile-link">
View Profile
</a>

<a href="index.html">
Back to Home
</a>

</div>


</div>

</body>

</html>