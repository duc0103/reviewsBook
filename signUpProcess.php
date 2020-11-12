<?php
   session_start();
    // Nếu không phải là sự kiện đăng ký thì không xử lý
    if (!isset($_POST['logup'])){
        die('');
    }
     
    //Nhúng file kết nối với database
    include('includes/dbConfig.php');
          
    //Khai báo utf-8 để hiển thị được tiếng việt
    header('Content-Type: text/html; charset=UTF-8');
          
    //Lấy dữ liệu từ file dangky.php
    $username   = addslashes($_POST['username']);
    $password   = addslashes($_POST['password']);
    $email      = addslashes($_POST['email']);
    $fullname   = addslashes($_POST['name']);
    $phone      = addslashes($_POST['phone']);

    $image ="";
    if (isset($_POST['logup']) && isset($_FILES['fileUpload'])) {
        if ($_FILES['fileUpload']['error'] > 0)
            echo "Upload lỗi rồi!";
        else {
            $image=$_FILES['fileUpload']['name'];
            move_uploaded_file($_FILES['fileUpload']['tmp_name'], 'bootstrap/img/' . $_FILES['fileUpload']['name']);
            echo "upload thành công <br/>";
            echo 'Dường dẫn: bootstrap/img/' . $_FILES['fileUpload']['name'] . '<br>';
            echo 'Loại file: ' . $_FILES['fileUpload']['type'] . '<br>';
            echo 'Dung lượng: ' . ((int)$_FILES['fileUpload']['size'] / 1024) . 'KB';
        }
    }
    //Kiểm tra người dùng đã nhập liệu đầy đủ chưa
    if (!$username || !$password || !$email || !$fullname || !$image)
    {
        echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }
          
        // Mã khóa mật khẩu
        // $password = md5($password);
          
    //Kiểm tra tên đăng nhập này đã có người dùng chưa
    if (mysqli_num_rows(mysqli_query($conn,"SELECT username FROM users WHERE username='$username'")) > 0){
        echo "Tên đăng nhập này đã có người dùng. Vui lòng chọn tên đăng nhập khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }
          
    //Kiểm tra email có đúng định dạng hay không
    if (!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$^", $email))
    {
        echo "Email này không hợp lệ. Vui long nhập email khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }
          
    //Kiểm tra email đã có người dùng chưa
    if (mysqli_num_rows(mysqli_query($conn,"SELECT email FROM users WHERE email='$email'")) > 0)
    {
        echo "Email này đã có người dùng. Vui lòng chọn Email khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }
    //Kiểm tra dạng nhập vào của ngày sinh
          
    //Lưu thông tin thành viên vào bảng
    $query=" INSERT INTO users (
        username,
        password,
        permission,
        name,
        phone,
        avatar,
        email,
        namePermission
    )
    VALUES (
        '{$username}',
        '{$password}',
        0,  
        '{$fullname}',
        '{$phone}',
        '{$image}',
        '{$email}',
        'member'
    )
";
    $addmember = mysqli_query($conn,$query) ;
                          
    //Thông báo quá trình lưu
    if ($addmember)
       header('location:index.php');
    else
        echo("Error description: " . mysqli_error($con));
      
?>