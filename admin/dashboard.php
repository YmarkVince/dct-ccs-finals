<?php
include '../functions.php';  
include './partials/header.php';  
include './partials/side-bar.php';  


$conn = openCon();
$subjectCount = $conn->query("SELECT COUNT(*) AS count FROM subjects")->fetch_assoc()['count'];
$studentCount = $conn->query("SELECT COUNT(*) AS count FROM students")->fetch_assoc()['count'];
$failedStudentsCount = $conn->query("SELECT COUNT(*) AS count FROM students WHERE grade < 50")->fetch_assoc()['count'];  // Assuming grade < 50 is considered failed
$passedStudentsCount = $conn->query("SELECT COUNT(*) AS count FROM students WHERE grade >= 50")->fetch_assoc()['count'];  // Assuming grade >= 50 is considered passed

closeCon($conn);
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5">    
    <h1 class="h2">Dashboard</h1>        

   
    <div class="row mt-5">
        
     
        <div class="col-12 col-xl-3">
            <div class="card border-primary mb-3">
                <div class="card-header bg-primary text-white border-primary">Number of Subjects:</div>
                <div class="card-body text-primary">
                    <h5 class="card-title"><?php echo $subjectCount; ?></h5>
                </div>
            </div>
        </div>


        <div class="col-12 col-xl-3">
            <div class="card border-primary mb-3">
                <div class="card-header bg-primary text-white border-primary">Number of Students:</div>
                <div class="card-body text-success">
                    <h5 class="card-title"><?php echo $studentCount; ?></h5>
                </div>
            </div>
        </div>

      
        <div class="col-12 col-xl-3">
            <div class="card border-danger mb-3">
                <div class="card-header bg-danger text-white border-danger">Number of Failed Students:</div>
                <div class="card-body text-danger">
                    <h5 class="card-title"><?php echo $failedStudentsCount; ?></h5>
                </div>
            </div>
        </div>

        
        <div class="col-12 col-xl-3">
            <div class="card border-success mb-3">
                <div class="card-header bg-success text-white border-success">Number of Passed Students:</div>
                <div class="card-body text-success">
                    <h5 class="card-title"><?php echo $passedStudentsCount; ?></h5>
                </div>
            </div>
        </div>

    </div>    

</main>

