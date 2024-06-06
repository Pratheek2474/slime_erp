<?php




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Login</title>
</head>
<body>
    <nav class="navbar py-3" style="background-color:#141414;">
    <div class="container-fluid">
        <a class="navbar-brand text-light" href="#">
        <h5 class="m-auto">Slime Portal</h5>
        </a>
    </div>
    </nav>
    <section class="container mt-5 pt-5">
        <div class="row">
            <div class="col m-auto p-auto">
                <img src="images/slime-logo-vector.png" alt="logo" class="w-50">
            </div>
            <div class="col m-auto p-auto">
                <h2 class="mx-3 my-3 p-auto">Login</h2>
                <div class="card">
                    <div class="card-body">
                        <form action="login_check.php" method="post">
                            <div class="mb-3">
                                <label for="roll" class="form-label">Roll Number: </label>
                                <input type="text" class="form-control" placeholder="Enter roll number" name="roll">
                            </div>
                            <div class="mb-3">
                                <label for="pass" class="form-label">Password: </label>
                                <input type="password" class="form-control" placeholder="Enter password" name="pass">
                            </div>
                            <div class="mt-3 text-center">
                                <button class="btn btn-success" name="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <p class="text-5 my-3 text-secondary">To create a new student profile, contact your slime portal administrator</p>
            </div>
        </div>
    </section:>
</body>
</html>