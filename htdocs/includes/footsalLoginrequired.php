<?php
session_start();
include("../includes/dbconnection.php");
if (isset($_SESSION['footsalemail']) && isset($_SESSION['footsalpassword'])) {

    $email = mysqli_real_escape_string($con, $_SESSION['footsalemail']);
    $password = mysqli_real_escape_string($con, $_SESSION['footsalpassword']);
    $footsalID = mysqli_real_escape_string($con, $_SESSION['footsalID']);
    $user = $con->query("SELECT * FROM footsal.companies WHERE email='$email' AND password='$password'");
    if (mysqli_num_rows($user) == 1) {

    } else {
        header("location:./");

        echo 'incorrect credientials';
        return;
    }

} else {
    header("location:./");

    echo 'no session';
    return;
}

?>