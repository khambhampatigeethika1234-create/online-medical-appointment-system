<?php

session_start();

$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

if ($username === "admin" && $password === "admin123") {

    $_SESSION['admin'] = "admin";

    header("Location: admin_dashboard.php");
    exit();

} else {

    echo "<script>
            alert('Invalid Admin Username or Password');
            window.location.href='admin_login.html';
          </script>";
    exit();
}

?>