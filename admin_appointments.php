<?php
session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: admin_login.html");
    exit();
}

include "db.php";

$result = mysqli_query($conn, "SELECT * FROM appointments ORDER BY appointment_date, appointment_time");
?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Admin - Appointments</title>

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
    font-size:30px;
}

header p{
    font-size:18px;
    margin-top:10px;
}

/* Container */

.container{
    width:94%;
    max-width:1250px;
    margin:40px auto;
    background:white;
    padding:30px;
    border-radius:18px;
    box-shadow:0 5px 20px rgba(0,0,0,0.12);
}

h2{
    text-align:center;
    color:#0D47A1;
    font-size:28px;
    margin-top:5px;
}

/* Table */

.table-box{
    overflow-x:auto;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:30px;
    min-width:800px;
}

th{
    background:linear-gradient(135deg,#1976D2,#0D47A1);
    color:white;
    padding:16px;
    font-size:16px;
}

td{
    padding:15px;
    text-align:center;
    border-bottom:1px solid #ddd;
    font-size:15px;
}

tr:hover{
    background:#e3f2fd;
}

/* Status */

select{
    padding:9px;
    border:1px solid #bbb;
    border-radius:6px;
    font-size:14px;
}

button{
    padding:9px 15px;
    background:#1976D2;
    color:white;
    border:none;
    border-radius:6px;
    cursor:pointer;
    font-size:14px;
}

button:hover{
    background:#0D47A1;
}

/* Back button */

.back{
    display:inline-block;
    background:#1976D2;
    color:white;
    padding:13px 25px;
    text-decoration:none;
    border-radius:8px;
    margin-top:30px;
    font-size:16px;
}

.back:hover{
    background:#0D47A1;
}

/* Footer */

footer{
    margin-top:50px;
    background:#0D47A1;
    color:white;
    text-align:center;
    padding:20px;
}

</style>

</head>

<body>

<header>

<h1>🏥 Online Medical Appointment System</h1>

<p>📅 Admin - Appointment Management</p>

</header>


<div class="container">

<h2>📋 All Appointments</h2>


<div class="table-box">

<table>

<tr>

<th>ID</th>

<th>Patient Name</th>

<th>Doctor</th>

<th>Appointment Date</th>

<th>Appointment Time</th>

<th>Status</th>

</tr>


<?php

if(mysqli_num_rows($result) > 0)
{
    while($row = mysqli_fetch_assoc($result))
    {
?>

<tr>

<td>
<?php echo $row['id']; ?>
</td>

<td>
<?php echo htmlspecialchars($row['patient_name']); ?>
</td>

<td>
<?php echo htmlspecialchars($row['doctor']); ?>
</td>

<td>
<?php echo htmlspecialchars($row['appointment_date']); ?>
</td>

<td>
<?php echo htmlspecialchars($row['appointment_time']); ?>
</td>

<td>

<form action="update_status.php" method="POST">

<input
type="hidden"
name="id"
value="<?php echo $row['id']; ?>"
>

<select name="status">

<option value="Pending"
<?php
if($row['status']=="Pending")
echo "selected";
?>
>
Pending
</option>

<option value="Confirmed"
<?php
if($row['status']=="Confirmed")
echo "selected";
?>
>
Confirmed
</option>

<option value="Cancelled"
<?php
if($row['status']=="Cancelled")
echo "selected";
?>
>
Cancelled
</option>

</select>

<button type="submit">
Update
</button>

</form>

</td>

</tr>

<?php
    }
}
else
{
?>

<tr>

<td colspan="6">
No appointments found.
</td>

</tr>

<?php
}
?>

</table>

</div>


<div style="text-align:center;">

<a href="admin_dashboard.php" class="back">
← Back to Dashboard
</a>

</div>

</div>


<footer>

© 2026 Online Medical Appointment System | All Rights Reserved

</footer>

</body>

</html>