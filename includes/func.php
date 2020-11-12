<?php 
// lấy 
function getNameUser($user_id,$conn){
	$name = "";

	$sql = "SELECT username FROM users WHERE id = '$user_id'";
	$query = mysqli_query($conn,$sql);

	while ($data = mysqli_fetch_array($query)) {
	     $name = $data['name']; 
	 } 
	 return $name;
}
function getCategorySlug($category_id,$conn){
	$category_slug = "";

	$sql = "SELECT category_slug FROM categories WHERE category_id = '$category_id' ";
	$query = mysqli_query($conn,$sql);

	while ($data = mysqli_fetch_array($query)) {
	     $category_slug = $data['category_slug'];
	 } 
	 return $category_slug;
}
function getCategoryId($category_slug,$conn){
	$category_id = "";

	$sql = "SELECT category_id FROM categories WHERE category_slug = '$category_slug' ";
	$query = mysqli_query($conn,$sql);

	while ($data = mysqli_fetch_array($query)) {
	     $category_id = $data['category_id'];
	 } 
	 return $category_id;
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

function toSlug($str) {
    $str = trim(mb_strtolower($str));
    $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
    $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
    $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
    $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
    $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
    $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
    $str = preg_replace('/(đ)/', 'd', $str);
    $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
    $str = preg_replace('/([\s]+)/', '-', $str);
    return $str;
  }
  if (!function_exists("select4LatestBook")){
	function select4LatestBook($conn){
		$query = "SELECT *  FROM `posts`  WHERE category_id != '0' AND is_public = '1' ORDER BY post_id DESC
         limit 4";
        $result = mysqli_query($conn, $query);
		if(!$result){
		    echo "Can't retrieve data " . mysqli_error($conn);
		    exit;
        }     		
        return  $result;
	}
	}
	if (!function_exists(" selectAlltBooks")){
		function selectAlltBooks($conn){
			$query = "SELECT *  FROM `posts`  WHERE category_id != '0' AND is_public = '1' ORDER BY post_id DESC";
			$result = mysqli_query($conn, $query);
			if(!$result){
				echo "Can't retrieve data " . mysqli_error($conn);
				exit;
			}     		
			return  $result;
		}
		}
	
?>