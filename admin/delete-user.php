<?php 
if($_SESSION['user_role']==0){
    header("location: {$hostname}/admin/post.php");
 }
include "config.php";

$user_id= $_GET['id'];
$sql= "DELETE FROM user WHERE user_id= '{$user_id}'";
$result= mysqli_query($conn, $sql) or die("Query Failed");
if($result){
    header("location: {$hostname}/admin/users.php");
}
mysqli_close($conn);
?>