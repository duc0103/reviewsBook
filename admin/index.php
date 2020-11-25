<?php
    session_start();
    $isAdmin=false;
	if ($_SESSION['permission']==1){
        $isAdmin=true;
    }
    else{
        header('location:../signIn.php');
    }
?>
<?php 
    include_once("../includes/dbConfig.php");
	include_once("getData.php");
	include_once("conc.php");


	$post_id = "";
	$post_title = "";
	$post_editor = "";
	$post_category = "";
	$create_date = "";
	$post_public = "";

?>
    <div class=" container container-fluid">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<!-- ------------------------------------------------------------------------------------------ -->
				<h3> 
	  				<a href="add-post.php">
	  					<button type="button" class="btn-sm btn btn-dark">Trang chu 
	  						<span class="fa fa-plus"></span>
	  					</button>
	  				</a>
  				</h3>
  				</h3>
				<h3> 
	  				<a href="add-post.php">
	  					<button type="button" class="btn-sm btn btn-dark">Tạo một bài review mới 
	  						<span class="fa fa-plus"></span>
	  					</button>
	  				</a>
  				</h3> <!-- end caption -->

				<div class="post-list">
					<caption>Danh sách bài viết</caption>
					<table border="2px " width="80%" class="table table-hover">
						<thead>
							<tr>
								<th>Tiêu đề</th>
								<th>Người đăng</th>
								<th>Categories</td>
								<th>Thời gian đăng</th>
								<th>Tình trạng</th>
							</tr>
						</thead>
						<tbody>
								<?php
									$sql = "SELECT  user_id ,post_id,post_title,category_id,createdate,is_public  FROM `posts`  ORDER BY post_id DESC ";
									$query = mysqli_query($conn,$sql);
									while ($row = mysqli_fetch_array($query)) {
								?>
								<tr class="post-info show-action">
									<td><?php echo $row['post_title']; ?><br>
										<div class="action">
											<a href="edit.php?post_id=<?php echo $row['post_id'];?>">Sửa</a>
											<a href="delete.php?post_id=<?php echo $row['post_id'];?>">Xóa</a>
											
										</div>
									</td>
									<td><?php echo getNameUser($row['user_id'],$conn); ?></td>
									<td><?php echo getCategoryName($row['category_id'],$conn); ?></td>
									<td><?php echo $row['createdate']; ?></td>
									<td><?php 
									if($row['is_public'] == 0){
										echo "Editting";
									} else{
										echo "Public";
									}
									?></td>

								</tr>
							<?php } ?>
						</tbody>
					</table>	
				</div>

			</div> <!-- end col 11 -->
		</div>
	</div>