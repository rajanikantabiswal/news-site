<?php
include "config.php";
if(empty($_FILES['logo']['name'])){
    $file_name=  $_POST['old_logo'];
 }else{
   $errors= array();
   $file_name=$_FILES['logo']['name'];
   $file_type=$_FILES['logo']['type'];
   $file_temp=$_FILES['logo']['tmp_name'];
   $file_size=$_FILES['logo']['size'];
   $file_ext=end(explode('.',$file_name));
   $extensions=array('jpeg', 'jpg', 'png');

   if(in_array($file_ext, $extensions)=== false){
      $errors[]="Only jpeg, jpg and png format will support.";
   }
   if($file_size > 2097152){
      $errors[]= "file size must be 2 mb or lower";
   }

   if(empty($errors)==true){
      move_uploaded_file($file_temp, "images/".$file_name);
   }else{
      print_r($errors);
      die();
   }
}

$sql = "UPDATE setting SET website_name = '{$_POST["website-title"]}', logo='{$file_name}' , footer_text='{$_POST["footer_text"]}'";
$result=mysqli_query($conn, $sql);

if($result){
   header("location: {$hostname}/admin/setting.php");
}else{
  echo "Post upload unsuccessfull";
}

?>