<?php
session_start();
$user_level = "";
include_once("conc.php");
if  ($_SESSION['permission']==1)  {
    $user_level = $_SESSION['permission'];
    include_once("../includes/func.php");
} else {
    header('Location:_DOMAIN');
}


?>

<?php
	include_once("dbConfig.php");

if ($_GET["post_id"]) {
	$post_id = $_GET["post_id"];

	/*DELETE POST*/
	$sql_deletePost = "DELETE FROM posts WHERE post_id = '$post_id' ";
	mysqli_query($conn,$sql_deletePost);



	unlink('../../'.$thumb_path);

	header('Location:index.php');
}
