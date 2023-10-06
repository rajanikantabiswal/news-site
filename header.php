<?php
include "config.php";
$page= basename($_SERVER['PHP_SELF']);

switch($page){
    case "single.php":
        if(isset($_GET['id'])){
            $post_id= $_GET['id'];
            $sql_title= "SELECT title FROM post WHERE post_id= {$post_id}";
            $row_title= mysqli_fetch_assoc(mysqli_query($conn, $sql_title));
            $page_title= $row_title['title'];
        }else{
            $page_title= "No post found";
        }
        break;
    case "category.php":
        if(isset($_GET['cat_id'])){
            $cat_id= $_GET['cat_id'];
            $sql_title= "SELECT category_name FROM category WHERE category_id= {$cat_id}";
            $row_title= mysqli_fetch_assoc(mysqli_query($conn, $sql_title));
            $page_title= "Category : ". $row_title['category_name'];
        }else{
            $page_title= "No category found";
        }
        break;
    case "author.php":
        if(isset($_GET['a_id'])){
            $a_id= $_GET['a_id'];
            $sql_title= "SELECT first_name FROM user WHERE user_id= {$a_id}";
            $row_title= mysqli_fetch_assoc(mysqli_query($conn, $sql_title));
            $page_title= "Author: ". $row_title['first_name'];
        }else{
            $page_title= "No category found";
        }
        break;
    case "search.php":
            $page_title="Search for : "."{$_GET['search']}";
        break;
    default:
        $page_title= "News Site";

}

$sql_setting= "SELECT * FROM setting";
$result_setting= mysqli_query($conn, $sql_setting);
$row_setting=mysqli_fetch_assoc($result_setting);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $page_title ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
                <a href="index.php" id="logo"><img src="admin/images/<?php echo $row_setting['logo']?>"></a>
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class='menu'>
                    
                    <?php
                    include "config.php";
                    if(isset($_GET['cat_id'])){
                        $cat_id=$_GET['cat_id'];
                    }

                    echo "'<li><a href='$hostname'>Home</a></li>'";
                   
                    $sql= "SELECT * FROM category WHERE post > 0";
                    $result= mysqli_query($conn, $sql) or die("Query failed");
                    while($row=mysqli_fetch_assoc($result)){
                        if(isset($_GET['cat_id'])){
                        if($cat_id== $row['category_id']){
                            $active= "active";
                        }else{
                            $active="";
                        }
                        }
                    ?>
                    <li><a class='<?php echo "{$active}" ?>' href="category.php?cat_id=<?php echo $row['category_id']?>"><?php echo $row['category_name']?></a></li>
                    <?php }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
