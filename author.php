<?php include 'header.php';

include "config.php";
if(isset($_GET['a_id'])){
    $a_id=$_GET['a_id'];
}else{
    header("location: {$hostname}/");
}

$sql3= "SELECT * FROM user WHERE user_id={$a_id}";
$row3= mysqli_fetch_assoc(mysqli_query($conn, $sql3));
?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                <h2 class="page-heading">Author : <?php echo $row3['first_name'] ?></h2>

                <?php

$limit = 3;
if(isset($_GET['page'])){
    $page=$_GET['page'];
}else{
    $page=1;
}

$offset=($page-1)* $limit;
$sql= "SELECT * FROM post LEFT JOIN category ON post.category=category.category_id
LEFT JOIN user ON post.author= user.user_id WHERE user_id={$a_id} ORDER BY post.post_id DESC LIMIT {$offset}, {$limit}";


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
                                        <a href='author.php?a_id=<?php echo $row['user_id']?>'><?php echo $row['first_name'] ?></a>
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

$sql1="SELECT * FROM post WHERE author={$a_id}";
$result1= mysqli_query($conn, $sql1);

if(mysqli_num_rows($result1)>$limit){
$total_records=mysqli_num_rows($result1); 
$total_page = ceil($total_records/$limit);
?>
<ul class='pagination admin-pagination'>
<?php

if($page>1){
    echo '<li><a href="author.php?page='.($page-1).'& a_id='.($a_id).'">Prev</a></li>';
}

for($i=1;$i <= $total_page;$i++){
    if($i==$page){
        $active="active";
    }else{
        $active="";
    }
    echo '<li class='.$active.'><a href="author.php?page='.$i.'& a_id='.($a_id).'">'.$i.'</a></li>';
}
if($page<$total_page){
echo '<li><a href="author.php?page='.($page+1).'& a_id='.($a_id).'">Next</a></li>';
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
