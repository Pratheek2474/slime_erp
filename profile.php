<?php include 'headers.php'; ?>

<?php
$pfp_upload_Err = '';
$sql_info_comm = "SELECT * FROM info WHERE roll='{$_SESSION["roll"]}'";
$sql_info_res = mysqli_query($conn,$sql_info_comm);
$student_info = mysqli_fetch_all($sql_info_res,MYSQLI_ASSOC)[0];
if(isset($_POST['pfp_submit'])){
    $file_name = $_FILES['image']['name'];
    $temp_name = $_FILES['image']['tmp_name'];
    $allowed_types = ['jpeg','png','webp','gif','ico','svg','jpg','tiff'];
    $file_type = explode('.',$file_name);
    $file_type = strtolower(end($file_type));
    if(empty($file_name)){
        $pfp_upload_Err = 'Upload an image';
    }
    else if(!in_array($file_type,$allowed_types)){
        $pfp_upload_Err = 'Unsupported File Type';
    }
    else if(strlen($file_name) > 50){
        $pfp_upload_Err = 'File Name is too long';
    }
    if(empty($pfp_upload_Err)){
        $file_name = $_SESSION['roll'].'.'.$file_type;
        $folder = 'images/pfp/'.$file_name;
        move_uploaded_file($temp_name,$folder);
        $query = mysqli_query($conn, "UPDATE images SET file='$file_name' WHERE roll='{$_SESSION['roll']}'");
    }
}

?>

<section class="container mt-5 justify-content-center ">
        <div class="row">
            <div class="col col m-auto p-auto">
                <h2 class="mx-3 my-3 p-auto">Student Profile</h2>
                <div class="card">
                    <div class="card-body">
                            <?php
                                $res = mysqli_query($conn,"SELECT * FROM images WHERE roll='{$_SESSION['roll']}'");
                                $pfp = mysqli_fetch_all($res,MYSQLI_ASSOC)[0];
                            ?>
                            <div>
                                <img src="images/pfp/<?php echo $pfp['file'];?>" height="150" width="150" alt="pfp" style="border-radius: 50%;" class="d-block mx-auto my-2">
                            </div>
                            <div class="text-center mt-4" style="font-size:30px; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;"><?php echo $student_info['fname']." ".$student_info['lname']; ?></div>
                            <div class="text mx-4" style="font-size:25px; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">Roll Number: <?php echo $student_info['roll']; ?></div>
                            <div class="text mx-4" style="font-size:25px; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">Email Address: <?php echo $student_info['email']; ?></div>
                            <div class="text mx-4" style="font-size:25px; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">Date of Birth: <?php echo $student_info['dob']; ?></div>
                            <div class="text mx-4" style="font-size:25px; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">Gender: <?php echo $student_info['gender']; ?></div>
                            <div class="text mx-4" style="font-size:25px; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">Department: <?php echo $student_info['dept']; ?></div>
                            <div class="text mx-4" style="font-size:25px; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">Caste: <?php echo $student_info['caste']; ?></div>
                            <div class="text mx-4" style="font-size:25px; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">Contact: <?php echo $student_info['contact']; ?></div>
                            <form class="mt-3 mx-4" style="font-weight:bolder; width:400px" method="POST" enctype="multipart/form-data">
                                <label for='pfp' class="form-label">Upload Profile Photo</label>
                                <div class="input-group">
                                    <input type="file" class="form-control <?php echo !$pfp_upload_Err?: 'is-invalid';?>" name="image">
                                    <input type="submit" class="btn btn-success" value="Upload" name="pfp_submit">
                                    <div class="invalid-feedback">
                                    <?php echo $pfp_upload_Err; ?>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </section>