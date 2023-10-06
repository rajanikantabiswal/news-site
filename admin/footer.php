<!-- Footer -->
<?php
$sql_setting= "SELECT * FROM setting";
$result_setting= mysqli_query($conn, $sql_setting);
$row_setting=mysqli_fetch_assoc($result_setting);
?>
<div id ="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <span>© Copyright 2019 News | Powered by <a href="http://yahoobaba.net/"><?php echo $row_setting['footer_text'] ?></a></span>
            </div>
        </div>
    </div>
</div>
<!-- /Footer -->
</body>
</html>
