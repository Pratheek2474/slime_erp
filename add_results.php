<!DOCTYPE html>
<?php 
include 'database/database.php';
session_start();

if (isset($_GET['roll'])) {
    $roll = $_GET['roll'];
} else {
    header('Location: view_students.php');
    exit(); // Ensure no further code is executed
}

if (isset($_POST['submit'])) {
    // Sanitize inputs
    $M1 = filter_input(INPUT_POST, 'M1', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $ED = filter_input(INPUT_POST, 'ED', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $AP = filter_input(INPUT_POST, 'AP', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $BEE = filter_input(INPUT_POST, 'BEE', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $PSCP = filter_input(INPUT_POST, 'PSCP', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Prepare the SQL statement
    $sql = "UPDATE results SET M1 = '$M1', ED = '$ED', AP = '$AP', BEE = '$BEE', PSCP = '$PSCP' WHERE roll = '$roll'";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
      header('Location: view_students.php');
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <title>Update Student Results</title>
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
        </ul>
        <a class="d-flex ms-auto mx-5 btn btn-success" href="logout.php">
            Logout
        </a>
        </div>
    </div>
    </nav>

    <section class="container mt-5 pt-5">
        <div class="card">
            <div class="card-title m-3 p-2">
                <h1>Student Results - <?php echo htmlspecialchars($roll); ?></h1>
            </div>
            <div class="card-body">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?roll=' . urlencode($roll); ?>" class="row g-3">
                    <div class="row my-4">
                        <div class="col-5">
                            <h5>Mathematics-I</h5>
                        </div>
                        <div class="col-2">
                            <select class="form-select" name="M1" required>
                                <option selected disabled value="">...</option>
                                <option>S</option>
                                <option>A</option>
                                <option>B</option>
                                <option>C</option>
                                <option>D</option>
                                <option>P</option>
                                <option>F</option>
                            </select>
                        </div>
                    </div>

                    <div class="row my-4">
                        <div class="col-5">
                            <h5>Engineering Drawing</h5>
                        </div>
                        <div class="col-2">
                            <select class="form-select" name="ED" required>
                                <option selected disabled value="">...</option>
                                <option>S</option>
                                <option>A</option>
                                <option>B</option>
                                <option>C</option>
                                <option>D</option>
                                <option>P</option>
                                <option>F</option>
                            </select>
                        </div>
                    </div>

                    <div class="row my-4">
                        <div class="col-5">
                            <h5>Applied Physics</h5>
                        </div>
                        <div class="col-2">
                            <select class="form-select" name="AP" required>
                                <option selected disabled value="">...</option>
                                <option>S</option>
                                <option>A</option>
                                <option>B</option>
                                <option>C</option>
                                <option>D</option>
                                <option>P</option>
                                <option>F</option>
                            </select>
                        </div>
                    </div>

                    <div class="row my-4">
                        <div class="col-5">
                            <h5>Basic Electrical Engineering</h5>
                        </div>
                        <div class="col-2">
                            <select class="form-select" name="BEE" required>
                                <option selected disabled value="">...</option>
                                <option>S</option>
                                <option>A</option>
                                <option>B</option>
                                <option>C</option>
                                <option>D</option>
                                <option>P</option>
                                <option>F</option>
                            </select>
                        </div>
                    </div>

                    <div class="row my-4">
                        <div class="col-5">
                            <h5>Problem Solving and Computer Programming</h5>
                        </div>
                        <div class="col-2">
                            <select class="form-select" name="PSCP" required>
                                <option selected disabled value="">...</option>
                                <option>S</option>
                                <option>A</option>
                                <option>B</option>
                                <option>C</option>
                                <option>D</option>
                                <option>P</option>
                                <option>F</option>
                            </select>
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
