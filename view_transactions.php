<?php 
include 'database/database.php';
session_start();

$sql1 = "SELECT usertype FROM users WHERE roll='{$_SESSION['roll']}'";
$result = mysqli_query($conn,$sql1);
$type = mysqli_fetch_all($result,MYSQLI_ASSOC)[0]['usertype'];
if(!isset($_SESSION['roll']) || $type != 'admin'){
  header('Location: login.php');    
}
$sql = "SELECT * FROM transactions";
$results = mysqli_query($conn, $sql);
$trans = mysqli_fetch_all($results, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <title>All transactions</title>
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
                    <h2 class="mx-3 my-3 p-auto">Transactions</h2>
                    <div class="card">
                        <div class="card-body">
                            <?php if (empty($trans)): ?>
                                <p class="lead mt-3 text-center" style="font-weight: 500;">There are no transactions</p>
                            <?php endif; ?>
                            <?php if (!empty($trans)): ?>
                                <table class="table table-hover text-center table-bordered border rounded-">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 200px;">Roll Number</th>
                                            <th scope="col" style="width: 400px;">Name</th>
                                            <th scope="col" style="width: 100px;">Amount</th>
                                            <th scope="col" style="width: 100px;">Date&Time</th>
                                            <th scope="col" style="width: 100px;">Payment Id</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php for($i=0, $count=count($trans);$i<$count;$i++):
                                            $tran = $trans[$i];
                                             ?>
                                            <tr>
                                                <td><?php echo $tran['roll']; ?></td>
                                                <td><?php echo $tran['full_name']?></td>
                                                <td><?php echo $tran['amount']?></td>
                                                <td><?php echo $tran['timestamp']?></td>
                                                <td><?php echo $tran['payment_id']?></td>
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