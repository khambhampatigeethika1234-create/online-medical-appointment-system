<?php
session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: admin_login.html");
    exit();
}

include("db.php");

/* Get payment records */
$sql = "SELECT * FROM payments ORDER BY id DESC";
$result = $conn->query($sql);

/* Get total payment amount */
$total_sql = "SELECT SUM(amount) AS total_amount FROM payments";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();

$total_amount = $total_row['total_amount'] ?? 0;
?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Admin - Payments</title>

<style>

*{
    box-sizing:border-box;
}

body{
    margin:0;
    font-family:Arial,sans-serif;
    background:linear-gradient(135deg,#e3f2fd,#f8fbff);
}

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

.container{
    width:95%;
    max-width:1100px;
    margin:40px auto;
    background:white;
    padding:30px;
    border-radius:18px;
    box-shadow:0 5px 20px rgba(0,0,0,0.12);
}

h2{
    text-align:center;
    color:#0D47A1;
    font-size:30px;
}

.summary{
    text-align:center;
    background:#fff3e0;
    border:2px solid #ffb74d;
    padding:20px;
    border-radius:15px;
    margin:25px 0;
}

.summary h3{
    color:#e65100;
    margin:5px;
}

.amount{
    font-size:35px;
    font-weight:bold;
    color:#1976D2;
    margin-top:10px;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:30px;
}

th{
    background:#1976D2;
    color:white;
    padding:14px;
}

td{
    padding:12px;
    text-align:center;
    border-bottom:1px solid #ddd;
}

tr:hover{
    background:#f1f7ff;
}

.paid{
    color:green;
    font-weight:bold;
}

.back{
    display:inline-block;
    background:#1976D2;
    color:white;
    padding:13px 28px;
    text-decoration:none;
    border-radius:8px;
    margin-top:30px;
}

.back:hover{
    background:#0D47A1;
}

footer{
    margin-top:60px;
    background:#0D47A1;
    color:white;
    text-align:center;
    padding:20px;
}

@media(max-width:800px){

    .container{
        overflow-x:auto;
    }

    table{
        min-width:800px;
    }

}

</style>

</head>

<body>

<header>

<h1>🏥 Online Medical Appointment System</h1>

<p>💳 Admin - Payment Management</p>

</header>


<div class="container">

<h2>💳 Payment Management</h2>


<div class="summary">

<h3>Total Payment Amount</h3>

<div class="amount">
₹<?php echo number_format($total_amount, 2); ?>
</div>

</div>


<?php

if($result->num_rows > 0)
{

?>

<table>

<tr>

<th>ID</th>

<th>Patient Name</th>

<th>Doctor</th>

<th>Appointment Date</th>

<th>Appointment Time</th>

<th>Amount</th>

<th>Payment Method</th>

<th>Status</th>

</tr>


<?php

while($row = $result->fetch_assoc())
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
₹<?php echo htmlspecialchars($row['amount']); ?>
</td>

<td>
<?php echo htmlspecialchars($row['payment_method']); ?>
</td>

<td class="paid">
<?php echo htmlspecialchars($row['payment_status']); ?>
</td>

</tr>

<?php

}

?>

</table>

<?php

}
else
{

?>

<div class="summary">

<h3>No Payment Records Found</h3>

<p>
Payment records will appear here after a successful payment.
</p>

</div>

<?php

}

?>


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