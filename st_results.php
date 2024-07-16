<?php include 'headers.php'; 

$sql1 = "SELECT * FROM results WHERE roll='{$_SESSION['roll']}'";
$sql1q=mysqli_query($conn,$sql1);
$result=mysqli_fetch_all($sql1q,MYSQLI_ASSOC)[0];

?>


<section class="container p-5 mt-5 justify-content-center">
    <div class="row d-flex justify-content-center">
        <h3 class="text-center" style="font-size:35px; font-weight:700; font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; letter-spacing:-2px">Results</h3>
        <div class="col ">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover table-bordered" style="font-size:20px">
                        <thead>
                            <th>S.No</th>
                            <th>Subject Code</th>
                            <th>Subject Name</th>
                            <th>Grade</th>
                        </thead>
                        <tbody>
                            <tr>
                            <th scope="row">1</th>
                            <td>M1</td>
                            <td>Mathematics-I</td>
                            <td><?php echo $result["M1"] ?></td>
                            </tr>
                            <tr>
                            <th scope="row">2</th>
                            <td>ED</td>
                            <td>Engineering Drawing</td>
                            <td><?php echo $result["ED"] ?></td>
                            </tr>
                            <tr>
                            <th scope="row">3</th>
                            <td>AP</td>
                            <td>Applied Physics</td>
                            <td><?php echo $result["AP"] ?></td>
                            </tr>
                            <tr>
                            <th scope="row">4</th>
                            <td>BEE</td>
                            <td>Basic Electrical Engineering</td>
                            <td><?php echo $result["BEE"] ?></td>
                            </tr>
                            <tr>
                            <th scope="row">5</th>
                            <td>PSCP</td>
                            <td>Problem Solving and Computer Programming</td>
                            <td><?php echo $result["PSCP"] ?></td>
                            </tr>
                            <tr>
                            
                            <td colspan="3" class="table-success" style="text-align:end; font-weight:600;">Total CGPA</td>
                            <td><?php echo $result["cgpa"]?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</section>