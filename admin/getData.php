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

function getThumbpath($img_id,$conn){
	$thumb_path = "";

	$sql_getImgPath = "SELECT img_path FROM images WHERE img_id = '$img_id' ";
	$query_getImgPath = mysqli_query($conn,$sql_getImgPath);

	while ($getImgPath = mysqli_fetch_array($query_getImgPath) ) {
	    $thumb_path = $getImgPath['img_path'];
	}
	return $thumb_path;
} 

function getImgIdFromPost($post_id,$conn){
	$img_id = "";

	$sql = "SELECT img_id FROM posts WHERE post_id = '$post_id' ";
	$query = mysqli_query($conn,$sql);
	
	while ($row = mysqli_fetch_array($query) ){
	    $img_id = $row['img_id'];
	}

	return $img_id;
}

function getImgPathFromImgId($img_id,$conn){

	$img_path = "";

	$sql = "SELECT img_path FROM images WHERE img_id = '$img_id' ";
	$query = mysqli_query($conn,$sql);

	while ($row = mysqli_fetch_array($query) ){
	    $img_path = $row['img_path'];
	}

	return $img_path;
}

function delImageFromId($img_id,$conn){

	$sql = "DELETE FROM images WHERE img_id = '$img_id' ";
	mysqli_query($conn,$sql);
}
