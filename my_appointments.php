<?php

session_start();

include("db.php");

$patient_name = $_SESSION['patient_name'] ?? '';

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>My Appointments</title>

<style>

body{
    font-family:Arial,sans-serif;
    background:#f5f9ff;
    margin:0;
}

header{
    background:#1976D2;
    color:white;
    text-align:center;
    padding:20px;
}

header h1{
    margin:0;
}

header p{
    margin:6px 0 0;
}

.container{
    width:90%;
    max-width:1000px;
    margin:35px auto;
    background:white;
    padding:25px;
    border-radius:12px;
    box-shadow:0 4px 15px rgba(0,0,0,0.12);
}

h2{
    color:#1976D2;
    text-align:center;
    margin-bottom:25px;
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#1976D2;
    color:white;
    padding:14px;
    text-align:center;
}

td{
    padding:13px;
    border-bottom:1px solid #ddd;
    text-align:center;
}

tr:hover{
    background:#f5f9ff;
}

.status{
    padding:6px 12px;
    border-radius:15px;
    font-weight:bold;
    display:inline-block;
}

.pending{
    background:#fff3cd;
    color:#856404;
}

.confirmed{
    background:#d4edda;
    color:#155724;
}

.completed{
    background:#d1ecf1;
    color:#0c5460;
}

.cancelled{
    background:#f8d7da;
    color:#721c24;
}

.no-data{
    text-align:center;
    padding:30px;
    color:#777;
}

.back{
    display:block;
    width:150px;
    margin:25px auto 0;
    padding:12px;
    text-align:center;
    background:#1976D2;
    color:white;
    text-decoration:none;
    border-radius:6px;
}

.back:hover{
    background:#0D47A1;
}

@media(max-width:700px){

    .container{
        overflow-x:auto;
    }

    table{
        min-width:700px;
    }

}

</style>

</head>

<body>

<header>

<h1>Online Medical Appointment System</h1>

<p>Your Health, Our Priority</p>

</header>


<div class="container">

<h2>My Appointments</h2>


<?php

if($patient_name == '')
{

    echo "<div class='no-data'>
            Please login to view your appointments.
          </div>";

}
else
{

    $stmt = $conn->prepare(
        "SELECT id, patient_name, doctor, appointment_date,
                appointment_time, status
         FROM appointments
         WHERE patient_name = ?
         ORDER BY appointment_date DESC, appointment_time DESC"
    );

    $stmt->bind_param("s", $patient_name);

    $stmt->execute();

    $result = $stmt->get_result();


    if($result->num_rows > 0)
    {

?>

<table>

<tr>

<th>Appointment ID</th>

<th>Patient Name</th>

<th>Doctor</th>

<th>Date</th>

<th>Time</th>

<th>Status</th>

</tr>


<?php

while($row = $result->fetch_assoc())
{

    $status = strtolower($row['status']);

    $status_class = '';

    if($status == 'pending')
    {
        $status_class = 'pending';
    }
    elseif($status == 'confirmed')
    {
        $status_class = 'confirmed';
    }
    elseif($status == 'completed')
    {
        $status_class = 'completed';
    }
    elseif($status == 'cancelled')
    {
        $status_class = 'cancelled';
    }

?>

<tr>

<td>
<?php echo htmlspecialchars($row['id']); ?>
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

<span class="status <?php echo $status_class; ?>">

<?php echo htmlspecialchars(ucfirst($row['status'])); ?>

</span>

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

        echo "<div class='no-data'>
                You don't have any appointments yet.
              </div>";

    }

}

?>

<a href="index.html" class="back">
Back to Home
</a>

</div>

</body>

</html>