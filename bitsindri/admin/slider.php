<?php include_once('header_admin.php'); ?>

<script type="text/javascript">
    function Confirm() {
        if (confirm("Are you sure to Delete")) {
            return true;
        } 
        else {
            return false;
        }
    }
</script>

<div id="layoutSidenav_content">
    <main>
        <?php if(@$_GET['error']){?>
            <center style="text-align:center;cursor:pointer;" id="hide" title='Close It'><a onclick="document.getElementById('hide').style.display='none'"><span style="padding: 10px; background-color: #ffffff; color: #ff0000; font-size: 20px; font-weight: bold; border-radius: 5px; "><?php echo @$_GET['error']; ?>
                </span></center>
        <?php }else if(@$_GET['done']){?>       
            <center style="text-align:center;cursor:pointer;" id="hide" title='Close It'><a onclick="document.getElementById('hide').style.display='none'"><span style="padding: 10px; background-color: #ffffff; color: #00ff00; font-size: 20px; font-weight: bold; border-radius: 5px; "><?php echo @$_GET['done']; ?>
                </span></center>
        <?php }else{ echo ""; } ?>

        <div class="container-fluid">
            <h1 class="mt-4">Slider Images Published</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Slider</li>
            </ol>

            <div class="row">
                <fieldset class="form-group border p-3 w-100">
                    <legend class="w-auto px-2">Upload New Slider</legend>

                    <form role="form" id="form" name="form" method="post" action="" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="inputFile">File</label>
                                    <input name="file" class="form-control b-none" id="inputFile" type="file" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputHeading">Heading <sub>(slider)</sub></label>
                            <input name="heading" class="form-control py-4" id="inputHeading" type="text" placeholder="Heading of slider..." />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="small mb-1" for="inputDesc">Description</label>
                                    <textarea name="description" rows="2" class="form-control py-4" id="inputDesc" type="text" placeholder="Write description here..." /></textarea> 
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-4 mb-0">
                            <input class="btn btn-success float-right" type="submit" name="save" value="Add & Published" class="btn btn-success">
                        </div>
                    </form>
                </fieldset>
            </div>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                SliderTable
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>SN.</th>
                                <th>Heading</th>
                                <th>Description</th>
                                <th>View</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $i = 1;
                                $query = mysqli_query($conn, "SELECT * FROM slider");
                                while(@$row = mysqli_fetch_array($query)){
                                  $sdr_id = $row['sdr_id'];
                                  $file = $row['file']; 
                                  $heading = $row['heading'];
                                  $description = $row['description'];
                            ?>
                            <tr>
                                <td><?php echo $i; $i++; ?></td>
                                <td><?php echo $heading; ?></td>
                                <td><?php echo substr($description, 0, 450); ?></td>
                                <td><img src="../assets/img/slider/<?php echo $file; ?>" id="admin_img"></td>
                                <td><a onclick='return Confirm();' href="delete_slider.php?id=<?php echo $sdr_id; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include_once('footer_admin.php'); ?>

<?php
    if(isset($_POST['save'])){
        $error = ""; $done = "";

        $usr_id = $_SESSION['session_id'];
        $heading = mysqli_real_escape_string($conn, $_POST['heading']);
        $description = mysqli_real_escape_string($conn, $_POST['description']); 
        $type = $_FILES['file']['type'];

        function compress_image($source_url, $destination_url, $quality, $date)
       {
          $info = getimagesize($source_url);

          if ($info['mime'] == 'image/jpeg')
          $image = imagecreatefromjpeg($source_url);

          elseif ($info['mime'] == 'image/gif')
          $image = imagecreatefromgif($source_url);

          elseif ($info['mime'] == 'image/png')
          $image = imagecreatefrompng($source_url);

          imagejpeg($image, $destination_url, $quality, $date);
          return $date.'.jpg';
        }
          
        if (($type == "image/jpeg") || ($type == "image/png") || ($type == "image/pjpeg")){
            if ($_FILES["file"]["error"] > 0) {
              $error = $_FILES["file"]["error"];
              echo "<script>window.open('slider.php?error=".$error."','_self');</script>";
              exit();
            }

            $run = mysqli_query($conn, "INSERT INTO slider(file,heading,description,usr_id) values('".compress_image($_FILES["file"]["tmp_name"], '../assets/img/slider/'.date('dmYHis').'.jpg', 40, date('dmYHis'))."','$heading','$description','$usr_id')");

            if($run){
                echo "<script>window.open('slider.php?done=Saved successfully.','_self');</script>";
                exit();
            }else {
                $error = "Problem on uploading image!";
                echo "<script>window.open('slider.php?error=".$error."','_self');</script>";
                exit();
            }
        }else{
          $error = "Image type is not valid!";
          echo "<script>window.open('slider.php?error=".$error."','_self');</script>";
          exit();
        }
    }
 ?>