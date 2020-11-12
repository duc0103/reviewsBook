<?php session_start(); 
 
if (isset($_SESSION['username'])){
    unset($_SESSION['username']); // xóa session login
    
}
if (isset($_SESSION['permission'])){
    unset($_SESSION['permission']); // xóa session login
    
}
$_SESSION['IsSignIn']=false;
header('location:index.php');
?>
