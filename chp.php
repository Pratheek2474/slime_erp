<?php 
include 'headers.php';


$cpasserr = '';
$conpasserr = '';

if(isset($_POST['submit'])) {
    // Fetch the current password from the database
    $sql1 = "SELECT pass FROM users WHERE roll='{$_SESSION['roll']}'";
    $result = mysqli_query($conn, $sql1);
    $oldpass = mysqli_fetch_all($result,MYSQLI_ASSOC)[0]['pass'];
    // Sanitize and validate the input data
    $cpass = filter_input(INPUT_POST, 'cpass', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $newpass = filter_input(INPUT_POST, 'newpass', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $conpass = filter_input(INPUT_POST, 'conpass', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Check if current password matches
    if (!password_verify($cpass,$oldpass)) {
        $cpasserr = "Current Password is Incorrect";
    }

    // Check if new password and confirm password match
    if ($newpass != $conpass) {
        $conpasserr = "Both Passwords Don't Match";
    }

    // If no errors, update the password
    if (empty($cpasserr) && empty($conpasserr)) {
        $newpass = password_hash($newpass,PASSWORD_DEFAULT);
        $sql2 = "UPDATE users SET pass='$newpass' WHERE roll='{$_SESSION['roll']}'";
        if (mysqli_query($conn, $sql2)) {
            echo '<div class="alert alert-success d-flex justify-content-cneter" role="alert">
            <i class="bi bi-check-circle-fill mx-3"></i>
            <div>
              Password Changed Successfully!
            </div>
          </div>';
        } else {
            echo "Error updating password: " . mysqli_error($conn);
        }
        }
        }
        
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Change Password</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
</head>
<body>       
    <section class="container mt-5 pt-5">
        <div class="card">
            <div class="card-title m-3 p-2"><h1>Change Password</h1></div>
            <div class="card-body">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="row g-3">
                    <div class="">
                        <label for="cpass" class="form-label">Current Password</label>
                        <input type="password" class="form-control" name="cpass" required>
                        <div class="text-danger"><?php echo $cpasserr; ?></div>
                    </div>
                    <div class="">
                        <label for="newpass" class="form-label">New Password</label>
                        <input type="password" class="form-control" name="newpass" required>
                    </div>
                    <div class="">
                        <label for="conpass" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="conpass" required>
                        <div class="text-danger"><?php echo $conpasserr; ?></div>
                    </div>
                    <div class="">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                            <label class="form-check-label" for="invalidCheck2">Agree to terms and conditions</label>
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
