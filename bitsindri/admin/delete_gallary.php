<?php 
    include("./connect_db.php");
    if(isset($_POST)){
        
        $id = $_GET['id'];

        $que ="SELECT * FROM gallary WHERE glr_id='$id'";
        $run =mysqli_query($conn, $que);
        
        while($row=mysqli_fetch_array($run))
        {
            $file = $row['file'];
        }

        $query = "DELETE FROM gallary WHERE glr_id='$id'";

        if(mysqli_query($conn, $query)){

            //delete specific image file
            if($file !=""){
    		    array_map('unlink', glob("../assets/img/gallary/$file"));
            }

            echo "<script>window.open('gallary.php?done=File deleted successfully.','_self')</script>";
        }
    	else{
    			
    		echo "<script>window.open('gallary.php?error= File not Deleted.','_self');</script>";
    	}
    }

?>