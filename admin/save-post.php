<?php
include "config.php";
session_start();

$title=mysqli_real_escape_string($conn, $_POST['post_title']);
$description=mysqli_real_escape_string($conn, $_POST['postdesc']);
$category=mysqli_real_escape_string($conn, $_POST['category']);
$date=date('d M, Y');
$author=$_SESSION['user_id'];

if(isset($_FILES['fileToUpload'])){
   $errors= array();
   $file_name=$_FILES['fileToUpload']['name'];
   $file_type=$_FILES['fileToUpload']['type'];
   $file_temp=$_FILES['fileToUpload']['tmp_name'];
   $file_size=$_FILES['fileToUpload']['size'];
   $file_ext=strtolower(end(explode('.',$file_name)));
   $extensions=array('jpeg', 'jpg', 'png');

   if(in_array($file_ext, $extensions)=== false){
      $errors[]="Only jpeg, jpg and png format will support.";
   }
   if($file_size > 2097152){
      $errors[]= "file size must be 2 mb or lower";
   }

   if(empty($errors)==true){
      move_uploaded_file($file_temp, "upload/".$file_name);
   }else{
      print_r($errors);
      die();
   }
}


$sql= "INSERT INTO post(title, description, category, post_date, author, post_img) VALUES('{$title}', '$description', '$category', '$date', '$author', '$file_name');";
$sql .= "UPDATE category SET post= post + 1 WHERE category_id= {$category}";
$result=mysqli_multi_query($conn, $sql) or die("Query failed");

if($result){
   header("location: {$hostname}/admin/post.php");
}else{
  echo "Post upload unsuccessfull";
}

// if(isset($_FILE['']))
?>