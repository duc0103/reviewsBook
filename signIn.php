
<?php
      session_start();
      $title="Đăng Nhập";
      include('includes/dbConfig.php');  
      include('includes/header.php')  ;
		  $_SESSION['IsSignIn']=false;
	  if(isset($_POST['login'])){
		  $username=$_POST['username'];
		  $password=$_POST['password'];
		  $sql="select * from users where  username='$username' and password='$password' limit 1";
		  $query=mysqli_query($conn,$sql);
		  $nums=mysqli_num_rows($query);
		  if($nums>0){ 
			  $row=mysqli_fetch_array($query);
        $_SESSION['username']=$username;
        $_SESSION['user_id']=$row["user_id"];
        $_SESSION['permission']=$row["permission"];
        $_SESSION["avatar"]=$row["avatar"];
        $_SESSION['IsSignIn']=true;
          if($_SESSION['permission']==1){
            header('location:admin/index.php');
          }
          else {
            header('location:index.php');
          }
			  
			  }else{
		      echo"<script> alert('Tài khoản không đúng!')</script>";
		      }		  
	  }
?>

  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Đăng nhập</h5>
            <form class="form-signin" action="#" method="POST" >
              <div class="form-label-group">
                <input type="text" id="textUserName" name="username" class="form-control" placeholder="Tài khoản của bạn"  required autofocus>
                <label for="textUserName">Tài khoản của bạn</label>
              </div>
              <div class="form-label-group">
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Mật Khẩu" required>
                <label for="inputPassword">Mật Khẩu</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">Quên Mật khẩu</label>
              </div>
              <input type="submit" name="login" id="button" value="Đăng nhập" class="btn btn-primary btn-lg  btn-block text-uppercase" >
              <hr class="my-4">
            
            </form>
            
              <a href="signUp.php" style="">
                <button class="btn btn-lg  btn-block text-uppercase" >Đăng kí
                </button>
              </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  
    require_once "includes/footer.php";
  ?>
  
