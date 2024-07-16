<?php 
include 'database/database.php';
session_start();

$sql1 = "SELECT usertype FROM users WHERE roll='{$_SESSION['roll']}'";
$result = mysqli_query($conn,$sql1);
$type = mysqli_fetch_all($result,MYSQLI_ASSOC)[0]['usertype'];
if(!isset($_SESSION['roll']) || $type != 'admin'){
  header('Location: login.php');    
}
$sql = "SELECT * FROM info";
$results = mysqli_query($conn, $sql);
$students = mysqli_fetch_all($results, MYSQLI_ASSOC);
$sql2 = "SELECT * FROM results";
$result1 = mysqli_query($conn, $sql2);
$rslt = mysqli_fetch_all($result1, MYSQLI_ASSOC);

if (isset($_POST['add_result'])) {
    $roll_to_add_result = $_POST['roll_to_add_result'];
    header('Location: add_results.php?roll=' . $roll_to_add_result);
    exit();
}
if (isset($_POST['remove'])) {
    $roll_to_remove = $_POST['roll_to_remove'];
    $sql = "DELETE FROM info WHERE roll='{$roll_to_remove}'";
    $sql1 = "DELETE FROM users WHERE roll='{$roll_to_remove}'";
    $sql3 = "DELETE FROM results WHERE roll='{$roll_to_remove}'";
    $sql4 = "DELETE FROM fee WHERE roll='{$roll_to_remove}'";
    $sql5 = "DELETE FROM images WHERE roll='{$roll_to_remove}'";
    mysqli_query($conn, $sql);
    mysqli_query($conn, $sql1);
    mysqli_query($conn, $sql3);
    mysqli_query($conn, $sql4);
    mysqli_query($conn, $sql5);
    header('Location: view_students.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

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
        <main>
            <section class="container mt-5 pt-5">
            <div class="row">
                <div class="col m-auto p-auto">
                    <h2 class="mx-3 my-3 p-auto">Students</h2>
                    <div class="card">
                        <div class="card-body">
                            <?php if (empty($students)): ?>
                                <p class="lead mt-3 text-center" style="font-weight: 500;">There are no students</p>
                            <?php endif; ?>
                            <?php if (!empty($students)): ?>
                                <table class="table table-hover text-center table-bordered border rounded-">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 200px;">Roll Number</th>
                                            <th scope="col" style="width: 400px;">Name</th>
                                            <th scope="col" style="width: 100px;">View Student</th>
                                            <th scope="col" style="width: 100px;">View Result</th>
                                            <th scope="col" style="width: 100px;">Add Result</th>
                                            <th scope="col" style="width: 100px;">Remove Student</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php for($i=0, $count=count($students);$i<$count;$i++):
                                            $student = $students[$i];$rlt = $rslt[$i];
                                            
                                             ?>
                                            <tr>
                                                <td><?php echo $student['roll']; ?></td>
                                                <td><?php echo $student['fname']." ".$student['lname']; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="<?php echo "#"."view"."{$student['roll']}"?>">View</button>
                                                    <div class="modal fade" id="<?php echo "view"."{$student['roll']}"?>" tabindex="-1" aria-labelledby="viewLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                                            <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5" id="viewLabel">Student Details</h1>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="card">
                                                                            <div class="card-body p-5" style="font-weight: 600; text-align:left; font-size:20px;">
                                                                                <div class="row">
                                                                                    <div class="col">Roll Number: </div>
                                                                                    <div class="col text-4 text-danger"><?php echo $student['roll']; ?></div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col">First Name: </div>
                                                                                    <div class="col text-4 text-danger"><?php echo $student['fname']; ?></div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col">Last Name: </div>
                                                                                    <div class="col text-4 text-danger"><?php echo $student['lname']; ?></div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col">Date of Birth: </div>
                                                                                    <div class="col text-4 text-danger"><?php echo $student['dob']; ?></div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col">Gender: </div>
                                                                                    <div class="col text-4 text-danger"><?php echo $student['gender']; ?></div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col">Caste: </div>
                                                                                    <div class="col text-4 text-danger"><?php echo $student['caste']; ?></div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col">Contact Number: </div>
                                                                                    <div class="col text-4 text-danger"><?php echo $student['contact']; ?></div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col">Department: </div>
                                                                                    <div class="col text-4 text-danger"><?php echo $student['dept']; ?></div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col">Email: </div>
                                                                                    <div class="col text-4 text-danger"><?php echo $student['email']; ?></div>
                                                                                </div>
                                                                                </div>
                                                                                </div>
                                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="<?php echo "#"."viewRlt"."{$rlt['roll']}"?>">Viesw</button>
                                                    <div class="modal fade" id="<?php echo "viewRlt"."{$rlt['roll']}"?>" tabindex="-1" aria-labelledby="viewLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                                            <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5" id="viewLabel">Student Results</h1>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="card">
                                                                            <div class="card-body p-5" style="font-weight: 600; text-align:left; font-size:20px;">
                                                                                <div class="row">
                                                                                    <div class="col">M1: </div>
                                                                                    <div class="col text-4 text-danger"><?php echo $rlt['M1']; ?></div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col">ED: </div>
                                                                                    <div class="col text-4 text-danger"><?php echo $rlt['ED']; ?></div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col">AP: </div>
                                                                                    <div class="col text-4 text-danger"><?php echo $rlt['AP']; ?></div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col">BEE: </div>
                                                                                    <div class="col text-4 text-danger"><?php echo $rlt['BEE']; ?></div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col">PSCP: </div>
                                                                                    <div class="col text-4 text-danger"><?php echo $rlt['PSCP']; ?></div>
                                                                                </div>
                                                                                </div>
                                                                                </div>
                                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                            <td>
                                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                                    <input type="hidden" name="roll_to_add_result" value="<?php echo $rlt['roll']; ?>">
                                                    <input type="submit" name="add_result" class="btn btn-danger" value="ADD">
                                                </form>
                                            </td>

                                                <td><form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                                <input type="hidden" name="roll_to_remove" value="<?php echo $student['roll']; ?>"> 
                                                <input type="submit" name="remove" class="btn btn-danger" value="Remove"></form></td>
                                            </tr>
                                        <?php endfor; ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
</body>
</html>