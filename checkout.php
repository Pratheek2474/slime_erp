<?php

include 'headers.php';
if(!isset($_SESSION['order_id']) || !isset($_SESSION['payment_initiated'])) {
        header('Location: payments.php');
}
include 'config.php';
require('razorpay-php/Razorpay.php');

$order_id = $_SESSION['order_id'];
$amount = $_SESSION['order_amt'];
$callback_url = "success.php";
$current_date_time = date('Y-m-d H:i:s');
unset($_SESSION['order_id']);

echo '<script src="https://checkout.razorpay.com/v1/checkout.js"></script>';

echo '<script>
    function startPayment() {
        var options = {
            key: "' . $keyId . '", // Enter the Key ID generated from the Dashboard
            amount: ' . $amount . ', // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
            currency: "INR",
            name: "Slime Portal",
            description: "Fee Payment through Slime Portal",
            image: "images/hello.png",
            order_id: "' . $order_id . '", 
            prefill: {
                name: "'.$_SESSION['roll'].'",
            },
            notes: {
                address: "Slime Portal Hyderabad HQ"
            },
            theme: {
                "color": "#124076",
                "backdrop_color": "#001524"
            },
            callback_url: "' . $callback_url . '",
            handler: function (response){
                window.location.href = "success.php?payment_id=" + response.razorpay_payment_id +
                                   "&order_id=" + response.razorpay_order_id +
                                   "&signature=" + response.razorpay_signature +
                                   "&timestamp=' . $current_date_time . '" +
                                   "&amount=' . $amount . '";
            },
            modal: {
                ondismiss: function(){
                    window.location.href = "failure.php";
                }
            }
        };
        var rzp = new Razorpay(options);
        rzp.on("payment.failed", function (response){
            window.location.href = "failure.php";
        });
        rzp.open();
    }
        window.onload = startPayment;


</script>';
?>

