<?php
include_once("includes/dbConfig.php");
include_once("includes/func.php");

$cate_id = "";
$cate_name = "";

if ( isset($_GET['category_slug']) ) {
	if (empty($cate_id = getCategoryId( $_GET['category_slug'],$conn )) ) {
		header("Location:404.html");
	} else {
		  $sql_select_post = "SELECT book_image,post_id,post_title,post_description,createdate,category_id,key_word,is_public,post_slug FROM posts
        WHERE category_id != '0' AND is_public = '1' AND category_id = '$cate_id' ORDER BY post_id DESC LIMIT 10";
        $query_select_post = mysqli_query($conn,$sql_select_post);
        echo mysqli_error($conn);
		$num_post = mysqli_num_rows($query_select_post);
		$cate_name = getCategoryName($cate_id,$conn);

	}
	} else {
		header("Location:404.html");
    }
    $title=$cate_name;
?>

<?php include_once("includes/header.php");?>

	</style>
</head>
<body>
<div class="container mt-1">
        <h1>Thể loại  <?php echo	$cate_name; ?></h1> 
      <div class="row">
      <?php if ( $num_post==0) { ?>
        <h4 style = "margin : auto ">Chưa có giới thiệu sách trong thể loại này</h4>
      <?php } ?>
        <?php while ( $book = mysqli_fetch_array( $query_select_post) ) { ?>
          <div class="col-md-3 col-sm-6">
            <div class="card card-block">
            <img class="card-img-top imagebook" src="../bootstrap/img/<?php echo $book['book_image']; ?>" alt="Card image cap">
              <h5 class="card-title mt-3 mb-3">
              <a href="<?php echo DOMAIN.'/'.$book['post_slug'].'-'.$book['post_id'].'.html';?>">
                <?php echo $book['post_title']; ?>
              </a>
              </h5>
              <p class="card-text"><?php echo $book['post_description']; ?></p> 
        </div>
          </div>   
              <?php } ?>
      </div>
     
      </div>

<?php include_once("includes/footer.php");?>