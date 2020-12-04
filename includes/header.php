<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    // require_once "includes/dbConfig.php";
    if(isset($_SESSION['email'])){
      $customer = getCustomerIdbyEmail($_SESSION['email']);
      $name=$customer['firstname'];
    }
    define('DOMAIN','http://'.$_SERVER['HTTP_HOST'].'/BookReview');
    ob_start();
    if(!isset($title)){
        $title="Giới Thiệu Sách";
    }
    $sql_select_category = "SELECT category_id,category_slug,category_name FROM categories";
    $query_select_category = mysqli_query($conn,$sql_select_category);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        .contentReviews{
            width:960px;
            margin:auto;
            max-width:100%;

        }
        @media screen and (max-width: 600px) {
            body {
                width:100%;
            }
        }

        a:hover {
            text-decoration: none;
        }

        .navbar {
            background-color: #484848;
        }

        .navbar .navbar-nav .nav-link {
            color: #fff;
        }

        .navbar .navbar-nav .nav-link:hover {
            color: #fbc531;
        }

        .navbar .navbar-nav .active>.nav-link {
            color: #fbc531;
        }
        .imagebook{
        height:300px;
        width:100%;
        object-fit:cover;
        }

        div [class^="col-"]{
        padding-left:5px;
        padding-right:5px;
        }
        .card{
        transition:0.5s;
        }
        .card-title {  
        font-size:15px;
        transition:1s;
        cursor:pointer;
        color:#18d4ca;

        }
        .card-title a{  
            color: #18d4ca;
            font-size: 20px;
        }

        .card-text{
        height:80px;  
        overflow: hidden;
        }

    </style>
</head>
<body>  
    <nav class="navbar navbar-expand-lg navbar-light ">
        <a class="navbar-brand" href="">Giới thiệu sách</a>
                <form  method="post" action="<?= DOMAIN ?>/search_book.php"  style="margin-top:7px">
                    <div style="display:flex">
                    <input type="text" class="form-control" id="inputPassword2" placeholder="Tìm Kiếm" name="textSearch">
                        <button type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-search"></span> Search
                            </button>
                        </button>
                    </div>
                       
                    </form>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">   
            <ul class="navbar-nav ml-auto topnav"> 
                <li class="nav-item ">
                    <a class="nav-link" href="<?= DOMAIN ?>">Trang Chủ <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Đã Đọc</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= DOMAIN ?>/all_post.php">Tất cả sách</a>
                </li>
                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Thể loại
                    </a>
                    <div class="bg-secondary dropdown-menu " aria-labelledby="navbarDropdown">
                    <?php while ($row = mysqli_fetch_array($query_select_category) ) { ?>
                        <a class="dropdown-item" href="<?= DOMAIN ?>/category/<?= $row['category_slug']?>"> <?php echo $row['category_name']?> </a>
                        <?php }?>
                    </div>
                </li>
                <?php if(!isset($_SESSION['IsSignIn']) || !$_SESSION['IsSignIn']) { ?>
                <li class="nav-item pl-1 idSignIned">
                        <a class="nav-link" href="<?= DOMAIN ?>/signIn.php"><i class="fa fa-user-plus fa-fw mr-1"></i>Đăng nhập</a>
                </li>
                <li class="nav-item pl-1 idsignIned">
                        <a class="nav-link" href="<?= DOMAIN ?>/signUp.php"><i class="fa fa-sign-in fa-fw mr-1"></i>Đăng kí</a>
                </li>'
                <?php }
                
                 else { ?>
                    <li class="nav-item pl-1 idsignIned"> 
                    <img src="<?php echo  DOMAIN.'/bootstrap/img/'.$_SESSION["avatar"] ?> "  alt="image user" height="30px" width="30px" class="img-circle" style="border-radius:50%">
                    </li>
                    <li class="nav-item pl-1 idsignIned"> 
                    <a class="nav-link" href="#"><i class="fa fa-sign-in fa-fw mr-1"></i> 
                        <?php echo $_SESSION["username"]?>
                        </a>
                    </li>
                    <li class="nav-item pl-1 idsignIned">
                        <a class="nav-link" href="<?php echo  DOMAIN.'/logout.php'?>"><i class="fa fa-sign-in fa-fw mr-1"></i>Thoát</a>
                     </li>
               <?php }?>
            </ul>
        </div>
    </nav>
    <!--- Navbar --->