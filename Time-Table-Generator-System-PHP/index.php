<?php include('admin/includes/dbconnection.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Time Table Generator  System</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#!">Time Table Generator (TTG)</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="admin/login.php">Admin</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page header with logo and tagline-->
        <header class="py-5 bg-light border-bottom mb-4">
            <div class="container">
                <div class="text-center my-5">
                    <h1 class="fw-bolder">Time Table Generator System</h1>
                    <!-- <p class="lead mb-0">A Bootstrap 5 starter layout for your next blog homepage</p> -->
                </div>
            </div>
        </header>
        <!-- Page content-->
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                
                <!-- Side widgets-->
                <div class="col-lg-12">
                    <!-- Search widget-->

                    <!-- Categories widget-->

                    <div class="card mb-4">
                        <div class="card-header">Current Time Table Details</div>
                        <div class="card-body">


  <h4 align="center">Current Time Table</h4>

                                        <table  class="table table-striped table-bordered" border="1">
      
        <tr>
            <th>Class</th>
            <th>Day</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Subject</th>
            <th>Teacher</th>
            <th>Classroom</th>
        </tr>
        <?php 
$sql = "SELECT 
    classes.name AS class,
    timeslots.day, timeslots.start_time, timeslots.end_time, 
    subjects.name AS subject, 
    teachers.name AS teacher, 
    classrooms.room_no 
FROM timetable 
JOIN classes ON timetable.class_id = classes.id
JOIN timeslots ON timetable.timeslot_id = timeslots.id
JOIN subjects ON timetable.subject_id = subjects.id
JOIN teachers ON timetable.teacher_id = teachers.id
JOIN classrooms ON timetable.classroom_id = classrooms.id
ORDER BY classes.name, timeslots.day, timeslots.start_time";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{  ?>

        <tr>
            <td><?php echo $row->class; ?></td>
            <td><?php echo $row->day ?></td>
            <td><?php echo $row->start_time; ?></td>
            <td><?php echo $row->end_time; ?></td>
            <td><?php echo $row->subject; ?></td>
            <td><?php echo $row->teacher; ?></td>
            <td><?php echo $row->room_no; ?></td>
        </tr>
        <?php }} else{  ?>
    <tr>
            <td colspan="7">No time generated yet</td>

        </tr>
    <?php } ?>

    </table>
                                        
              
                        </div>
                    </div>
                  
                    <!-- Side widget-->
       
                </div>
            </div>
        </div>
        <!-- Footer-->

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
