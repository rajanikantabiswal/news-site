<?php include 'header.php'; 
include "config.php";
$cat_id=$_GET['cat_id'];
$sql2="SELECT category_name FROM category WHERE category_id={$cat_id}";
$result2=mysqli_query($conn, $sql2);
$row=mysqli_fetch_assoc($result);

?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">

                

<?php

$limit = 3;
if(isset($_GET['page'])){
    $page=$_GET['page'];
}else{
    $page=1;
}

$offset=($page-1)* $limit;

$sql= "SELECT * FROM post LEFT JOIN category ON post.category=category.category_id
LEFT JOIN user ON post.author= user.user_id WHERE category={$cat_id} ORDER BY post.post_id DESC LIMIT {$offset}, {$limit}";

$result= mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){

?>
    <div class="post-content">
        <div class="row">
            <div class="col-md-4">
                <a class="post-img" href="single.php?id=<?php echo $row['post_id']?>"><img src="admin/upload/<?php echo $row['post_img'] ?>" alt=""/></a>
            </div>
            <div class="col-md-8">
                <div class="inner-content clearfix">
                    <h3><a href='single.php?id=<?php echo $row['post_id']?>'><?php echo $row['title'] ?></a></h3>
                    <div class="post-information">
                        <span>
                            <i class="fa fa-tags" aria-hidden="true"></i>
                            <a href='category.php?cat_id=<?php echo $row['category']?>'><?php echo $row['category_name'] ?></a>
                        </span>
                        <span>
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <a href='author.php'><?php echo $row['first_name'] ?></a>
                        </span>
                        <span>
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <?php echo $row['post_date'] ?>
                        </span>
                    </div>
                    <p class="description">
                    <?php echo $row['description'] ?>
                    </p>
                    <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id']?>'>read more</a>
                </div>
            </div>
        </div>
    </div>

    <?php
            
        }
    }
    ?>
<!-- Pagination Code start -->
<?php
$sql1="SELECT * FROM post WHERE category={$cat_id}";
$result1= mysqli_query($conn, $sql1);

if(mysqli_num_rows($result1)>$limit){
$total_records=mysqli_num_rows($result1); 
$total_page = ceil($total_records/$limit);
?>
<ul class='pagination admin-pagination'>
<?php
if($page>1){
    echo '<li><a href="category.php?page='.($page-1).'& cat_id='.($cat_id).'">Prev</a></li>';
}

for($i=1;$i <= $total_page;$i++){
    if($i==$page){
        $active="active";
    }else{
        $active="";
    }
    echo '<li class='.$active.'><a href="category.php?page='.$i.'& cat_id='.($cat_id).'">'.$i.'</a></li>';
}
if($page<$total_page){
echo '<li><a href="category.php?page='.($page+1).'& cat_id='.($cat_id).'">Next</a></li>';
}
?>
 
</ul>
<?php 
}
?>
<!-- pagination code end -->
</div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
