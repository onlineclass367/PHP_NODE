<?php session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['ttgaid']==0)) {
  header('location:logout.php');
  } else{

?>
<!DOCTYPE html>
<html lang="en">

<head>
   
    <title>Time Table Generator :  Generate Time Table</title>

       <!-- Styles -->
    <link href="../assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="../assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="../assets/css/lib/menubar/sidebar.css" rel="stylesheet">
    <link href="../assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/lib/unix.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>
<?php include_once('includes/sidebar.php');?>
   
    <?php include_once('includes/header.php');?>
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Current Time table</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="dashboard.php">Dashboard</a></li>
                                    <li class="active">Current Time Table </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <div id="main-content">
                    <div class="row">
                    
                        <div class="col-md-12">
                            <div class="card alert">
                        <!--         <div class="card-header pr">
                                    <h4>Current Time Table</h4>
                                    
                               
                                </div> -->
                                <div class="card-body">
                                    <a href="generate_timetable.php" class="btn btn-primary"> Generate New Time Table</a>
                                    <br />
                                    <small style="color:red;">Once new time table generate old one will delete</small>
                                    <br /><br />
                                    <div class="table-responsive">
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
                            </div>
                        </div>
                        <!-- /# column -->

                    </div>
                    <!-- /# row -->

                    <?php include_once('includes/footer.php');?>
                </div>
            </div>
        </div>
    </div>







    <!-- jquery vendor -->
    <script src="../assets/js/lib/jquery.min.js"></script>
    <script src="../assets/js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="../assets/js/lib/menubar/sidebar.js"></script>
    <script src="../assets/js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->
    <script src="../assets/js/lib/bootstrap.min.js"></script>
    <!-- bootstrap -->
    <script src="../assets/js/scripts.js"></script>
    <!-- scripit init-->





</body>

</html><?php }  ?>