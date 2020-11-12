<?php
  session_start();
  $count = 0;
  $title = "Giới thiệu sách";
	include('includes/dbConfig.php');
  include('./includes/header.php');
  include('includes/func.php');
  require_once("admin/const.php");
  $result=select4LatestBook($conn);
        ?> 
      <p class="lead text-center text-muted">Các bài giới thiệu sách mới</p>
      <br><br>
      <div class="container mt-1">
      <div class="row">
        <?php while ( $book = mysqli_fetch_array($result) ) { ?>
          <div class="col-md-3 col-sm-6">
            <div class="card card-block">
            <img style=""class="card-img-top imagebook"src="./bootstrap/img/<?php echo $book['book_image']; ?>" alt="Card image cap">
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
  <?php
  if(isset($conn)) {mysqli_close($conn);}
  require_once "./includes/footer.php";
 
?>