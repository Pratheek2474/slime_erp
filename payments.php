<?php

use Razorpay\Api\Api;

 include 'headers.php';
        include 'config.php';
        require('razorpay-php/Razorpay.php')?>
<?php 
$fee_paid_statement = 'Fee is already paid';
$fee_unpaid_statement = 'Enter due amount (CAPTCHA)';
$sql_fetch_due_fee_command = "SELECT due_amt FROM fee WHERE roll='{$_SESSION['roll']}'";
$sql_fetch_due_fee_result = mysqli_query($conn,$sql_fetch_due_fee_command);
$due_fee = mysqli_fetch_all($sql_fetch_due_fee_result,MYSQLI_ASSOC)[0]['due_amt'];
$amt = 0;
$amtErr = '';
if(isset($_POST['submit'])){
    $fee = filter_input(INPUT_POST,'fee',FILTER_SANITIZE_NUMBER_INT); 
   if(empty($fee)){
    $amtErr = 'Enter a valid amount';
   }
   else if($fee != $due_fee){
    $amtErr = 'Enter correct amount';
   }
   if(empty($amtErr)){
    $api = new Api($keyId,$keySecret);
    $order = $api->order->create(array('receipt' => '123', 'amount' => ($fee * 100), 'currency' => 'INR'));
    $order_id = $order->id;
    
    $_SESSION['order_id'] = $order_id;
    $_SESSION['order_amt'] = $order->amount;
    $_SESSION['payment_initiated'] = true;
    header('Location: checkout.php');
    exit();      
    }
}
    
    

?>


<section class="container mt-5 pt-5 justify-content-center ">
        <div class="row">
            <div class="col col-sm-5 m-auto p-auto">
                <h2 class="mx-3 my-3 p-auto">Fee payment form</h2>
                <div class="card">
                    <div class="card-body">
                                <p style="color: red; font-weight:500; font-size:large">Due Amount: <?php echo $due_fee;?> Rs</p>
                                <?php
                                 if($due_fee == 0){
                                    echo '<p style="color:green;font-weight:500; font-size:large">Fee Paid. No due remaining.</p>';
                                }
                                ?>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <!-- Amount -->
                            <div class="mb-3">
                                <label for="fee" class="form-label">Enter due amount for confirmation (INR):</label>
                                <input type="text" class="form-control <?php echo !$amtErr ?:
          'is-invalid'; ?>" placeholder="<?php echo $due_fee == 0 ? $fee_paid_statement: $fee_unpaid_statement ?>" name="fee" <?php echo $due_fee != 0? :'disabled' ?>>
                                <div class="invalid-feedback">
                                    <?php echo $amtErr; ?>
                                </div>
                            </div>
                            <div class="mt-3 text-center">
                                <button class="btn btn-success" name="submit" <?php echo $due_fee != 0? :'disabled' ?>>Pay using Razorpay</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php include 'footer.php';?>