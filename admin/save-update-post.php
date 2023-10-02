<?php
    include "config.php";
    if(empty($_FILES['new-image'])){
        $file_name=$_POST['old-image'];
    }else{
        $errors= array();
        $file_name=$_FILES['new-image']['name'];
        $file_type=$_FILES['new-image']['type'];
        $file_temp=$_FILES['new-image']['tmp_name'];
        $file_size=$_FILES['new-image']['size'];
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

echo $sql= "UPDATE post SET title='{$_POST["post_title"]}', description='{$_POST["postdesc"]}', category={$_POST["category"]}, post_img='{$_POST["new-image"]}' WHERE post_id={$_POST["post_id"]}";
?>