<?php
if($_SESSION['user_role']==0){
    header("location: {$hostname}/admin/post.php");
 }
include "config.php";
$category_id= $_GET['id'];
$sql= "DELETE FROM category WHERE category_id = {$category_id}";
$result= mysqli_query($conn, $sql) or die("Query failed");
if($result){
    header("location: {$hostname}/admin/category.php");
}
?>