<?php
function getNameUser($user_id,$conn){
	$name = "";

	$sql = "SELECT username FROM users WHERE user_id = '$user_id'";
	$query = mysqli_query($conn,$sql);

	while ($data = mysqli_fetch_array($query)) {
	     $name = $data['username']; 
	 } 
	 return $name;
}

function getCategoryName($category_id,$conn){
	$categoryName = "";

	$sql = "SELECT category_name FROM categories WHERE category_id = '$category_id'";
	$query = mysqli_query($conn,$sql);

	while ($data = mysqli_fetch_array($query)) {
	     $categoryName = $data['category_name'];
	 } 
	 return $categoryName;
} 
