<?php
    include 'database/database.php';
    session_start();
    if (!isset($_SESSION['payment_initiated'])) {
        header('Location: payments.php');
        exit();
    }
    $sql_tran_command = "UPDATE fee SET due_amt=0 WHERE roll='{$_SESSION['roll']}'";
    $sql_tran_result = mysqli_query($conn, $sql_tran_command);
    unset($_SESSION['payment_initiated']);    
    $sql_info_command = "SELECT * FROM info WHERE roll='{$_SESSION['roll']}'";
    $sql_info_res = mysqli_query($conn,$sql_info_command);
    $info_std = mysqli_fetch_all($sql_info_res,MYSQLI_ASSOC)[0];
    $full_name_std = $info_std['fname'] . ' ' . $info_std['lname'];
    $transaction_amt = $_GET['amount'] / 100;
    $sql_store_command = "INSERT INTO transactions (roll,full_name,amount,payment_id,timestamp) VALUES ('{$_SESSION["roll"]}','{$full_name_std}','{$transaction_amt}','{$_GET["payment_id"]}','{$_GET["timestamp"]}')";
    $sql_store_result = mysqli_query($conn,$sql_store_command);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        .icon {
            color: #4caf50;
            font-size: 100px;
            margin-bottom: 20px;
        }
        h1 {
            color: #4caf50;
            margin-bottom: 20px;
        }
        p {
            color: #555;
            margin-bottom: 20px;
        }
        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <section class="container mt-5 pt-5 d-flex align-items-center justify-content-center">
        <div class="row">
            <div class="col m-auto p-auto">
                <div class="card m-5 p-5">
                    <div class="card-body">
                    <div class="d-flex align-items-center justify-content-center m-1">
                    <i class="fas fa-check-circle icon"></i>
                    </div>
                        <h4 style="color: #45a049;" class="text-center mb-3">Transaction Succesful!</h4>
                        <p class="text-center col" style="font-size: 20px; font-weight:500; color:#4caf50">Fee Payment of <?php echo $full_name_std ?> is Succesfully Done!</p>
                            <div class="details text-center" style="font-size: larger; font-weight:500">
                                <div class="text-success">Transaction Details:</div>
                                <h5>Roll Number: <?php echo $_SESSION['roll'] ?></h5>
                                <h5>Amount: <?php echo $_GET['amount']/100 . 'Rs' ?></h5>
                                <h5>Date & Time: <?php echo $_GET['timestamp'] ?></h5>
                                <h5>Payment Id: <?php echo $_GET['payment_id'] ?></h5>
                            </div>
                            <div class="mt-3 text-center">
                                <a href="st_index.php" class="btn btn-success">Back to Home</a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
</html>
