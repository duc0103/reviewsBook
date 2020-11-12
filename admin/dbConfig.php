<?php
	  $host='localhost';
	  $username='root';
	  $password='';
	  $dbname='reviewbooks';
      $conn=mysqli_connect($host,$username,$password,$dbname)    
      or
      die("Không thể kết nối database");
      mysqli_select_db($conn,$dbname) 
      or
        die("Không thể chọn database");
?>