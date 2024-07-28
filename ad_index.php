<?php 
include 'database/database.php';
session_start();

$sql1 = "SELECT usertype FROM users WHERE roll='{$_SESSION['roll']}'";
$result = mysqli_query($conn,$sql1);
$type = mysqli_fetch_all($result,MYSQLI_ASSOC)[0]['usertype'];
if(!isset($_SESSION['roll']) || $type != 'admin'){
  header('Location: login.php');    
}
?>

<?php
$query_male = mysqli_query($conn,"SELECT COUNT(roll) AS tot_std FROM info WHERE gender='male'");
$query_female = mysqli_query($conn,"SELECT COUNT(roll) AS tot_std FROM info WHERE gender='female'");
$query1_res_male = mysqli_fetch_all($query_male,MYSQLI_ASSOC);
$query1_res_female = mysqli_fetch_all($query_female,MYSQLI_ASSOC);
$tot_std_female = $query1_res_female[0]['tot_std'];
$tot_std_male = $query1_res_male[0]['tot_std'];
$tot_std = $tot_std_male + $tot_std_female;
$query2 = mysqli_query($conn,"SELECT COUNT(roll) AS tot FROM fee GROUP BY due_amt");
$query2_res = mysqli_fetch_all($query2,MYSQLI_ASSOC);
$tot_std_paid = $query2_res[0]['tot'];
$tot_std_unpaid = $query2_res[1]['tot'];
$query3 = mysqli_query($conn, "SELECT dept,COUNT(roll) AS cnt FROM info GROUP BY dept");
$query3_res = mysqli_fetch_all($query3,MYSQLI_ASSOC);
?>
<?php
$news_upload_Err = '';
if(isset($_POST['news_submit'])){
    $file_name = $_FILES['news']['name'];
    $temp_name = $_FILES['news']['tmp_name'];
    $folder = 'images/news/'.$file_name;
    $file_ext = explode('.',$file_name);
    $file_ext = strtolower(end($file_ext));
    $allowed_types = ['jpeg','png','webp','gif','ico','svg','jpg','tiff'];
    if(!$file_name) $news_upload_Err = 'Upload an image';
    else if(!in_array($file_ext,$allowed_types)) $news_upload_Err = 'Upload valid image file';
    else if(strlen($file_name) > 50) $news_upload_Err = 'File name must be less than 50 characters';
    if(empty($news_upload_Err)){
        move_uploaded_file($temp_name,$folder);
        $query_upload_news = mysqli_query($conn, "INSERT INTO images (roll,file,type) VALUES ('{$_SESSION["roll"]}','$file_name','news')");
    }
}

if(isset($_POST['notice'])){
    $heading = filter_input(INPUT_POST,'heading',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $notice_body = filter_input(INPUT_POST,'notice_body',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $notice_upload_query = mysqli_query($conn,"INSERT INTO notices (heading,body) VALUES ('$heading','$notice_body')");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Admin Index</title>
</head>
<body>
<nav class="navbar navbar-expand-lg sticky-top border-bottom border-dark border-2 rounded-bottom-5" style="font-size:21px; font-family:Arial, Helvetica, sans-serif; background-color:black">
    <div class="container-fluid">
        <a class="navbar-brand ms-auto" href="ad_index.php"><img src="images/hello.png" width="150" height="75"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mt-0 mb-lg-0">
            <li class="nav-item ms-4">
            <a class="nav-link active" aria-current="page" href="ad_index.php" style="color:aliceblue">Home</a>
            </li>
            <li class="nav-item ms-4">
            <a class="nav-link" href="addstd.php" aria-current="page" style="color:aliceblue">Register Student</a>
            </li>
            <li class="nav-item ms-4">
            <a class="nav-link" href="view_students.php" style="color:aliceblue">View Students</a>
            </li>
            <li class="nav-item ms-4">
            <a class="nav-link" href="view_transactions.php" style="color:aliceblue">View Transactions</a>
            </li>
        </ul>
        <a class="d-flex ms-auto mx-5 btn btn-success" href="logout.php">
            Logout
        </a>
        </div>
    </div>
    </nav>
    <section class="container p-5">
        <div class="row justify-content-center">
            <div class="col-sm-1">
                <img src="images/hello.png" alt="Slime Logo" width="150" height="75" class="d-block my-auto py-auto">
            </div>
            <div class="col-lg-10 text-center my-auto d-block" style="font-family:sans-serif; font-weight:700;font-size:50px;letter-spacing:-3.5px; word-spacing:8px">
            <p>All in one ERP for Student Management.<p>
            </div>
        </div>
        <hr class="mb-4">
        <h2 class="text-center m-3" style="font-family:sans-serif; font-weight:600;font-size:40px; letter-spacing:-2.5px">Student Dashboard</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-sm-5">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title row">
                            <h3>Total Students - <?php echo $tot_std; ?></h3>
                            <h4 class="col">Male - <?php echo $tot_std_male; ?></h4>
                            <h4 class="col">Female - <?php echo $tot_std_female; ?></h4>
                        </div>
                        <div class="card-text">
                            <h4 class="text-danger">Branch  Wise:</h4>
                            <ol style="font-size: large; font-weight:500">
                                <?php foreach($query3 as $branch):?>
                                    <li><?php echo $branch['dept']." - ".$branch['cnt']; ?></li>
                                <?php endforeach ?>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="card-title mb-4">
                            <h4>Upload News&Happenings</h4>
                        </div>
                        <div class="card-text">
                        <form style="font-weight:bolder; width:400px" method="POST" enctype="multipart/form-data">
                                <div class="input-group">
                                    <input type="file" class="form-control <?php echo !$news_upload_Err?: 'is-invalid';?>" name="news">
                                    <input type="submit" class="btn btn-success" value="Upload" name="news_submit">
                                    <div class="invalid-feedback">
                                    <?php echo $news_upload_Err; ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title row">
                            <h3 class="text-danger">Fee Status</h3>
                            <h4 class="col">Paid - <?php echo $tot_std_paid; ?></h4>
                            <h4 class="col">Unpaid - <?php echo $tot_std_unpaid; ?></h4>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="card-title row">
                            <h3 class="text-danger">Add Notice</h3>
                            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <label for="heading" class="form-label">
                                    <h4>Title:</h4>
                                </label>
                                <input type="text" class="form-control" placeholder="Enter Title" required name="heading">
                                <label for="notice_body" class="form-label mt-2"><h5>Body:</h5></label>
                                <textarea name="notice_body" class="form-control" rows="3" placeholder="Enter Detailed Info" required></textarea>
                                <div class="d-flex justify-content-center">
                                    <input type="submit" name="notice" value="Add Notice" class="btn btn-success mt-2" style="width: 200px;">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </section>
</body>
</html>
