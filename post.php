<?php 
			include_once("includes/dbConfig.php");
			include_once("includes/func.php");
			$post_id = "";
			$post_title = "";
			$post_content = "";
			$post_seo_title = "" ;
			$post_description = "";
			$post_keyword = "";
			$post_category = 0;
			$update_date = "";

			$post_involve_id = "";
			$post_involve_title = "";
			$post_involve_slug = "";

			$cache_time = 200;
			$cache_file = '';

			if (isset($_GET['post_id'])) {
				$post_id = $_GET["post_id"];

				$cache_file = 'cache/cache-'.$post_id.'.html';

				/*if (file_exists($cache_file) && time() - $cache_time < filemtime($cache_file)) {
					echo '///';
					 include($cache_file); //Xuất ra nội dung đã cache - file cache
					 exit; //ngừng tại đây, không chạy các lệnh bên dưới.
				}*/


				$sql = "SELECT post_title,post_content,book_name,post_description,key_word,category_id,createdate,updatedate FROM posts 
                WHERE post_id = '$post_id' ";
				$query = mysqli_query($conn,$sql);
				 
				 //PROCESS CONTENT POST
				$row = mysqli_fetch_array($query); 
				    $post_title = $row['post_title'];
					$post_content = $row['post_content'];
					$post_book_name = $row['book_name'];
					$post_description = $row['post_description'];
					$post_keyword = $row['key_word'];
					$post_category = $row['category_id'];
					$update_date = $row['updatedate'];
				

					$category_name = getCategoryName($post_category,$conn);
					$category_slug = getCategorySlug($post_category,$conn);
				//POST LIÊN QUAN
				$sql = "SELECT post_id,post_title,post_slug FROM posts  WHERE category_id='$post_category' AND post_id != '$post_id' AND category_id != '0' AND is_public = '1' ORDER BY post_id DESC LIMIT 0, 5 ";
				$query = mysqli_query($conn,$sql);
			} else {
				header("Location:404.html");
			}
			
?>
<?php
    $title= $post_title;

include_once("includes/header.php");
?>
<style>

	</style>
</head>
<body>
<?php include_once("includes/header.php");?>
<div class="container ">
	<div class="columns">
		<div class="column col-2"></div>			
		<div class="column col-md-12 col-8 ">
			<div class="post-main">
				<div class="card">
					<div class="card-header">
						<div class="card-title h3"><?php echo $post_title; ?></div>
					    <div class="text-gray"><i class="far fa-calendar-alt"></i> 
					    	<?php echo $update_date;?> 
					    	<a href="<?= DOMAIN ?>/category/<?= $category_slug ?>" class="text-link-gray">
								<?php echo $category_name;?> 
							</a>
					    </div>	
					</div>

					<div class="card-body">
						<strong><?php echo $post_description;?></strong>
						<div class="text-justify"><?php echo $post_content;?></div>
					</div>
				</div>
			</div>

			<div>
				<ul>
					<?php while ( $post_involve = mysqli_fetch_array($query) ) { ?>
						<li><a href="<?php echo DOMAIN.'/'.$post_involve['post_slug'].'-'.$post_involve['post_id'].'.html';?>">
							<?= $post_involve['post_title'] ?>
							</a>
						</li>
					<?php }?>
				</ul>
			</div>
		</div>
		<div class="column col-2"></div>
	</div>

</div>
<?php include_once("includes/footer.php");?>
<?php 
?>