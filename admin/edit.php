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
	include_once("dbConfig.php");


?>

<?php


	$username_edit = "";
	$id_user_edit = 0;
	if (isset($_SESSION['username']) ) {
		$username_edit = $_SESSION['username'];
	} 
	
	if (isset($_SESSION['user_id']) ) {
		$id_user_edit= $_SESSION['user_id'];
	} 


	$post_id = "";
	$post_title = "";
	$post_content = "";
	$isPublic = 0;
	$book_name = "" ;
	$post_description = "";
	$post_keyword = "";
	$post_category = 0;
	$post_slug = "";

	$publishOK = TRUE;


if(isset($_GET['post_id']) ){

	$post_id = $_GET['post_id'];

	$sql_GetPostId = "SELECT * FROM posts WHERE post_id = '$post_id' ";
	$query_GetPostId = mysqli_query($conn,$sql_GetPostId);
	 
	 //PROCESS CONTENT POST
	while ($getPostInfo = mysqli_fetch_array($query_GetPostId) ) {
	$post_title =$getPostInfo['post_title'];
			$post_content =$getPostInfo['post_content'];
			$book_name=$getPostInfo['book_name'];
			$post_description =$getPostInfo['post_description'];
			// $post_author=$_POST['post_author'];
			$post_keyword =$getPostInfo['key_word'];
			$post_slug = toSlug($post_title);
			if (isset($_POST['post_public'])) {
				$isPublic =$getPostInfo['post_public'];
			}
			if (isset($_POST['post_category'])) {
				$post_category =$getPostInfo['post_category'];
			}
}
}

	

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		
		if (isset($_POST['publish'])) {

			$post_title = $_POST['post_title'];
			$post_content = $_POST['post_content'];
			$book_name= $_POST['book_name'];
			$post_description = $_POST['post_description'];
			$post_author=$_POST['post_author'];
			$post_keyword = $_POST['post_keyword'];
			$post_slug = toSlug($post_title);
			if (isset($_POST['post_public'])) {
				$isPublic = $_POST['post_public'];
			}

			if (isset($_POST['post_category'])) {
				$post_category = $_POST['post_category'];
			}
			// image process-----------------------------------
		    $image ="";
                if ($_FILES['post_thumb']['error'] > 0)
                    echo "Upload lỗi rồi!";
                else {
                    $image=$_FILES['post_thumb']['name'];
                    move_uploaded_file($_FILES['post_thumb']['tmp_name'], '../bootstrap/img/' . $_FILES['post_thumb']['name']);
                    echo "upload thành công <br/>";
                    echo 'Dường dẫn: bootstrap/img/' . $_FILES['post_thumb']['name'] . '<br>';
                    echo 'Loại file: ' . $_FILES['post_thumb']['type'] . '<br>';
                    echo 'Dung lượng: ' . ((int)$_FILES['post_thumb']['size'] / 1024) . 'KB';
                }
			
			//INSERT POST INFO TO DB----------------------------------------
            $sql_add_post = "
            INSERT INTO `posts`(
                `post_title`,
                `post_content`,
                `user_id`,
                `is_public`,
                `createdate`,
                `updatedate`,
                `book_name`,
                `post_description`,
                `key_word`,
                `post_slug`,
                `book_image`,
                `category_id`
            )
            VALUES(
                '$post_title',
                '$post_content',
            	$id_user_edit,
                '$isPublic',
                now(),
                now(),
                '$book_name',
                '$post_description',
                '$post_keyword',
                '$post_slug',
                '$image',
                '$post_category'  
            ); ";

				if ($query_add_post = mysqli_query($conn,$sql_add_post) ) {

					//GET ID FROM POST AND USE GET METHOD TO EDIT POST
					$post_id = mysqli_insert_id($conn);
					header('Location:index.php');
					//--------------------
				} else {
					$publishOK = FALSE;
				}
		}
	}

?>
<?php include_once("../includes/header.php"); ?>
		  </style>
</head>
<body>

			
		<div class="container-fluid">
			<div class="row ">
				<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">

					<form method="post" action="" enctype="multipart/form-data">

						<!-- ------------------------COMMON CONTENT OF POST------------------------------------- -->
						<div class="add-new-post">
							<h3>Thêm bài Giới thiệu sách
				  				<a href="add-post.php">
				  					<button type="button" class="btn-sm btn btn-dark">
				  						<span>Thêm</span> 
				  						<span class="fa fa-plus"></span>
				  					</button>
				  				</a>
			  				</h3>
						</div> <!-- end add-new-post -->
						
						<div class="content-element">
							<div class="form-group">
		  						<input type="text" name="post_title" id="post_title" class="form-control" placeholder="Tiêu đề" value="<?php echo $post_title; ?>" >
			  				</div>
							<!-- thêm ảnh sử lí sau -->
							<!-- <div>
								<a href="?php echo '../img/add-image.php';?>" target="_BLANK">
				  					<button type="button" class="btn-sm btn btn-outline-dark mr-bottom">
				  						<span>Thêm ảnh</span> 
				  						<span class="fa fa-plus"></span>
				  					</button>
				  				</a>
			  				</div> -->

						    <div class="form-group">
                                <span> Nội dung</span>
						      <textarea class="form-control" id="post_content" name="post_content"><?php echo $post_content; ?></textarea>
						    </div>
                            <div class="form-group">
                            <span> Tên Sách</span>
						      <input class="form-control" id="$book_name" name="book_name" value= "<?php echo $book_name; ?>">
						    </div>
                            <div class="form-group">     
							<div class="form-inline">
								<label for="post_public">Đăng luôn</label>
								<input type="checkbox" name="post_public" class="form-control" id="post_public" value="1" <?php echo ($isPublic==1)?"checked":" "; ?> >
			  				</div>
						</div> <!-- end content-element -->

						<hr>

						<!-- /---------------------------SEO--------------------------------/ -->
						<div class="seo-element">
							<div class="card">
							    <div class="card-header">
							      <a class="card-link" data-toggle="collapse" href="#seo">
							      	<h6>
							      		<span class="text-dark">Các vấn Đề của sách</span> 
							      		<span><i class=" text-dark pull-right fa fa-caret-down "></i></span>
							      	</h6>
							      </a>
							    </div>

							    <div id="seo" class="collapse show">
							      <div class="card-body">
							      	<div class="form-group">
					                    <!-- Seo xử lí sau -->
										<!-- <div class="form-group">
											<label for="">SEO title: </label>
											<input type="text" name="post_seo_title" class="form-control" value="<?php echo $post_seo_title; ?>" >
										</div> -->

										<div class="form-group">
											<label for="">Thẻ giới thiệu  </label>
											<textarea class="form-control" name="post_description" ><?php echo $post_description; ?></textarea>
										</div>

										<div class="form-group">
											<label for="">Focus keyword: </label>
											<input type="text" name="post_keyword" class="form-control"<?php echo $post_keyword; ?> >
										</div>	
										<!-- <div class="form-group">
											<label for="">Tên tác giả</label>
											<input type="text" name="post_author" class="form-control" value="<?php echo $post_keyword; ?>" >
										</div>	 -->
									</div>
							      </div>
							    </div> <!-- end  seo collapse -->
							 </div> <!-- end yoast SEO  -->
						</div> <!-- end seo-element -->
					</div> <!-- end col-9 -->
                    </div>
					
					<!-- -----------------------COMMON INFO------------------------------------ -->
					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
				
						<div class="card">
						    <div class="card-header">
						      <a class="card-link" data-toggle="collapse" href="#post-info">
						      	<h6>
						      		<span class="text-dark">Thông tin chung</span> 
						      		<span><i class="text-dark pull-right fa fa-caret-down "></i></span>
						      	</h6>
						      </a>
						    </div>

						    <div id="post-info" class="collapse show">
						      <div class="card-body">
						      	<span class="post-info-item">
						      		<i class="fa fa-calendar" style="font-size:14px;"></i> 
						      		Thời gian đăng:
						      	</span> <br>
						      	<span class="post-info-item"><i class="fa fa-user" style="font-size:14px;"></i> Người đăng: <?php echo $username_edit;?></span><br>
						      	<span class="post-info-item"><i class="fa fa-cog" style="font-size:14px;"></i> Trạng thái: <?php echo ($isPublic == 1)?"Public":"Editing"; ?></span><br>

								<input type="submit" name="publish" class="btn btn-sm btn-info"  value="Publish">

						      </div>
						    </div>
						 </div> <!-- end post-info -->

						<hr>
								<!-- ------------------CATEGORIES------------------------------ -->
						<div class="card">
							<div class="card-header">
							  <a class="card-link" data-toggle="collapse" href="#post-category">
							  	<h6>
							  		<span class="text-dark">Thể loại</span> 
							  		<span><i class=" text-dark pull-right fa fa-caret-down "></i></span>
							  	</h6>
							  </a>
							</div>

							<div id="post-category" class="collapse show">
							  <div class="card-body">
							 	
						 		<?php 

						 			$sql_show_category = "SELECT * FROM categories";
						 			$query_show_category = mysqli_query($conn,$sql_show_category);
						 			while ($show_category = mysqli_fetch_array($query_show_category) ) {
						 		?>
						 		
								<div class="form-inline">
									<input type="checkbox" name="post_category" class="form-control form-category" 
										value="<?php echo $show_category['category_id']?>" 
										<?php echo ($post_category == $show_category['category_id'] )?"checked":" ";?> >
							 		<span><?php echo $show_category['category_name']; ?></span>
								 	
								</div>

						 		<?php 
						 			}
						 		?>
									 
							  </div>
							</div>
						</div> <!-- end post category <-->

						<!-- -----------------------THUMBNAILS----------------------------------- -->
						<hr>

						<div class="card">
						    <div class="card-header">
						      <a class="card-link" data-toggle="collapse" href="#post_thumb">
						      	<h6>
						      		<span class="text-dark">Ảnh nhỏ của sách </span> 
						      		<span><i class="text-dark pull-right fa fa-caret-down "></i></span>
						      	</h6>
						      </a>
						    </div>

						    <div id="post_thumb" class="collapse show">
						      <div class="card-body">
						      	<div class="form-group">
									 <input type="file" name="post_thumb" accept="image/*" class="form-control">
								</div>
						      </div>
						    </div>
						</div> <!-- END THUMBNAIL -->

	  				</div> <!-- end col 3 -->
				</form> <!-- END FORM -->
			</div> <!-- end row -->
		</div><!-- end container-fluid -->

<?php 
?>
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script> 
	<script>
							   
	    CKEDITOR.replace( 'post_content' );
	</script>

		