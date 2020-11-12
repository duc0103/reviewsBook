<title>Đăng kí</title>
<?php
      session_start();
      include('includes/dbConfig.php');  
      include('includes/header.php')  ;
	
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style>
          .left{
            width:150px;
          }
          .flex{
            display:flex;
            margin-top:10px;

          }
        </style>
    </head>
    <body>
    <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Đăng kí</h5>
            <form class="form-signin" action="signUpProCess.php" method="POST"enctype="multipart/form-data" >
            
              <div class="form-label-group flex ">
                <label class="left" for="inputName">Họ và tên </label>
                <input  type ="text" id="inputName" name="name" class="form-control" placeholder="Họ tên"  required autofocus>    
              </div>
              <div class="form-label-group flex ">
                <label class="left" for="inputName">Tên tài khoản </label>
                <input  type = "text" id="inputUsername" name="username" class="form-control" placeholder="Tên tài khoản"  required autofocus>    
              </div>
              <div class="form-label-group flex ">
                <label class="left" for="inputEmail">Email </label>
                <input  type ="email" id="inputEmail" name="email" class="form-control" placeholder="Email"  required autofocus>    
              </div>

              <div class="form-label-group flex ">
                <label class="left" for="inputPassword">Mật Khẩu</label>
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Mật Khẩu" required>
              </div>
              <div class="form-label-group flex ">
                <label class="left" for="inputPassword">Số điện thoại</label>
                <input type="text" id="inputPhone" name="phone" class="form-control" placeholder="Số điện thoại" required>
              </div>
              <div class="form-label-group flex ">
                <label class="left" for="inputImage">Ảnh đại diện </label>
                <input type="file" id="inputImage" name="fileUpload" class="form-control" placeholder="anh" required>
              </div>
              <hr class="my-4">
              <input type="submit" name="logup" id="button" value="Đăng kí" class="btn btn-primary btn-lg  btn-block text-uppercase" >
            </form>
            
              <a href="signIn.php" style="">
                <button class="btn btn-lg  btn-block text-uppercase" >Đăng nhập
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
    </body>
</html>
