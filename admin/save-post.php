<?php
include "config.php";
if(isset($_POST['submit'])){
   echo $post_title=$_POST['post_title'];
   echo $post_desc=$_POST['postdesc'];
   echo $post_category= $_POST['category'];
//    echo $post_image=$_POST['fileToUpload'];

   
}
?>