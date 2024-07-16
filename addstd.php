<!DOCTYPE html>
<?php 
include 'database/database.php';
session_start();
$flag = 0;
$sql1 = "SELECT usertype FROM users WHERE roll='{$_SESSION['roll']}'";
$result = mysqli_query($conn,$sql1);
$type = mysqli_fetch_all($result,MYSQLI_ASSOC)[0]['usertype'];
if(!isset($_SESSION['roll']) || $type != 'admin'){
  header('Location: login.php');    
}
if(isset($_POST['submit'])){

    $fname = filter_input(INPUT_POST,'fname',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lname = filter_input(INPUT_POST,'lname',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $roll = filter_input(INPUT_POST,'roll',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
    $dob = filter_input(INPUT_POST,'dob',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $gender = filter_input(INPUT_POST,'gender',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $dept = filter_input(INPUT_POST,'dept',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $caste = filter_input(INPUT_POST,'caste',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $contact = filter_input(INPUT_POST,'contact',FILTER_SANITIZE_NUMBER_INT);
    $pass = filter_input(INPUT_POST,'pass',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pass = password_hash($pass,PASSWORD_DEFAULT);
    $sql = "INSERT INTO info (fname, lname, roll, email, dob, gender, dept, caste, contact) VALUES ('$fname', '$lname', '$roll', '$email', '$dob', '$gender', '$dept', '$caste', '$contact')";
    $sql1 = "INSERT INTO users (roll, pass) VALUES ('$roll', '$pass')";
    $sql2 = "INSERT INTO fee (roll) VALUES ('$roll')"; //DEFAULT FEE IS 45000
    $sql3 = "INSERT INTO results (roll) VALUES ('$roll')";
    $query = mysqli_query($conn, "INSERT INTO images (roll,file,type) VALUES ('$roll','default_pfp.webp','pfp')");
    mysqli_query($conn, $sql);
    mysqli_query($conn, $sql1);
    mysqli_query($conn, $sql2);
    mysqli_query($conn,$sql3);
    header('Location: success_reg.php');
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <title>Register Student</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        
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

        
        <section class="container mt-5 pt-5">
        <div class="card">
            <div class="card-title m-3 p-2"><h1 >Registration Details</h1></div>
            <div class="card-body">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="row g-3">
    
  <div class="col-md-4">
    <label for="fname" class="form-label">First name</label>
    <input type="text" class="form-control" name="fname" required placeholder="FirstNmae">
  </div>
  <div class="col-md-4">
    <label for="lname" class="form-label">Last name</label>
    <input type="text" class="form-control" name="lname" required>
  </div>
  <div class="col-md-3">
    <label for="roll" class="form-label">Permanent Roll No.</label>
    <input type="text" class="form-control" name="roll" required>
  </div>
  <div class="col-md-4">
    <label for="email" class="form-label">Email</label>
    <div class="input-group">
      <span class="input-group-text" id="inputGroupPrepend2">@</span>
      <input type="email" class="form-control" name="email"  aria-describedby="inputGroupPrepend2" required>
    </div>
  </div>
  <div class="col-md-4">
                <div class="form-group">
                    <label for="datepicker">DOB</label>
                    <input type="text" class="form-control" name="dob" placeholder="DD/MM/YYYY">
                </div>
            </div>
  <div class="col-md-1">
    <label for="gender" class="form-label">Gender</label>
    <select class="form-select" name="gender" required>
      <option selected disabled value="">...</option>
      <option>Male</option>
      <option>Female</option>
      <option>Other</option>
    </select>
  </div>
  <div class="col-md-1">
    <label for="dept" class="form-label">Department:</label>
    <select class="form-select" name="dept" required>
      <option selected disabled value="">...</option>
      <option>CSE</option>
      <option>EEE</option>
      <option>ECE</option>
      <option>MCE</option>
      <option>CVE</option>
      <option>Jigarthanda</option>
    </select>
  </div>
  <div class="col-md-1">
    <label for="caste" class="form-label">Caste:</label>
    <input type="text" class="form-control" name="caste" required>
  </div>
  <div class="col-md-3">
    <label for="contact" class="form-label">Contact No:</label>
    <input type="text" class="form-control" name="contact" required>
  </div>
  <div class="col-md-4">
    <label for="pass" class="form-label">Default Password:</label>
    <input type="password" class="form-control" name="pass" required>
  </div>

  <div class="col-12">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
      <label class="form-check-label" for="invalidCheck2">
        Agree to terms and conditions
      </label>
    </div>
  </div>

  <div class="col-12 d-flex">
  <input type="submit" name="submit" value="Register" class="btn btn-dark w-25">
  </div>
</form>
        </div>
        </div>

    
    </section>
    </body>
</html>