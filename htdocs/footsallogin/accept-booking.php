<?php
include("../includes/footsalLoginrequired.php");
$email = mysqli_real_escape_string($con, $_SESSION['footsalemail']);
$password = mysqli_real_escape_string($con, $_SESSION['footsalpassword']);
$footsalID = mysqli_real_escape_string($con, $_SESSION['footsalID']);
if (isset($_GET['id'])) {
    $id=mysqli_real_escape_string($con,$_GET['id']);
    $fetch=$con->query("SELECT * FROM footsal.bookings WHERE id='$id' and companyId='$footsalID'");
    if(mysqli_num_rows($fetch)==1){
        $row = mysqli_fetch_object($fetch);
        $userId=$row->userId;
        $footsalName=$row->name;
        $price=$row->price;
        $location=$row->location;
       
    }
    $fetch=$con->query("SELECT * FROM footsal.users WHERE id='$userId'");
    if(mysqli_num_rows($fetch)==1){
        $row = mysqli_fetch_object($fetch);
        $useremail=$row->email;
        $date=$row->date;
        $time=$row->time;
    }
    if($con->query("UPDATE footsal.bookings SET `status`='accepted' WHERE id='$id' and companyId='$footsalID' ")){
        mail($useremail,"Booking accepted","Your booking has been accepted for id  ".$id." for footsal ".$footsalName." for price rs ".$price." at location ".$location." on ".$date." , ".$time);
        header("location:dashboard");
    }else{
        echo "error accepting booking";
    }
    
    
}
