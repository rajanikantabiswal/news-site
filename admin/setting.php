<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h1 class="admin-heading">Website Details</h1>
             </div>
              <div class="col-md-offset-3 col-md-6">
              <?php 
            include "config.php";
              
              $sql= "SELECT * FROM setting";
              $result = mysqli_query($conn, $sql) or die("Query Failed");
                $row=mysqli_fetch_assoc($result);
            ?>
                  <!-- Form for show edit-->
        <form action="save-setting.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <label for="exampleInputTile">Website Name</label>
                <input type="text" name="website-title"  class="form-control" id="exampleInputUsername" value="<?php echo $row['website_name']?>">
            </div>
            <div class="form-group">
                <label for="">Website Logo</label>
                <input type="file" name="logo" >
                <img  src="images/<?php echo $row['logo']?>" height="50px">
                <input type="hidden" name="old_logo" value="<?php echo $row['logo']?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Footer Description</label>
                <textarea name="footer_text" class="form-control"  required rows="5"><?php echo $row['footer_text']?></textarea>
            </div>
            
            
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>
        <!-- Form End -->

               
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
