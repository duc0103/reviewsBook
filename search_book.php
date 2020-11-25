<?php
  require_once "./includes/dbConfig.php";
  require_once "./includes/header.php";

  $text = trim($_POST['textSearch']);
  $query = "SELECT book_name,author_name, post_description,post_title ,post_slug,post_id ,book_image FROM posts  INNER JOIN author ON author.author_id=posts.author_id where book_name like'%$text%' or author_name like '%$text%' or post_title like '%$$text%' ";
  $result = mysqli_query($conn, $query);
  if(mysqli_num_rows($result)==0){
    echo '
    <div class="alert alert-warning" role="alert">
      Không tìm thấy 
    </div>' . ' <div class="search_top" >
       
 </div>';
  }else{
    $number=mysqli_num_rows($result);
   echo  '<div class="alert alert-success" role="success"> ';
   echo $number;
   echo ' Kết quả được tìm thấy </div>' . ' <div class="search_top" >       
</div>';

  }

?>
     
     <div class="container mt-1">
      <div class="row">
        <?php while ( $book = mysqli_fetch_array($result) ) { ?>
          <div class="col-md-3 col-sm-6">
            <div class="card card-block">
            <img style=""class="card-img-top imagebook" src="bootstrap/img/<?php echo $book['book_image']; ?>"  alt="Card image cap">
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
  if(isset($conn)) { mysqli_close($conn); }
  require_once "./includes/footer.php";
?>