<?php session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['ttgaid']==0)) {
  header('location:logout.php');
  } else{

if(isset($_POST['submit'])){
$fname=$_POST['fname'];
$subid=$_POST['subid'];

$query= $dbh -> prepare("select id from teachers where name=:fname");
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() == 0)
{

$query=$dbh->prepare("insert into teachers(name)values(:fname)");
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->execute();
$LastInsertId=$dbh->lastInsertId();
if($LastInsertId>0) {
$query=$dbh->prepare("insert into teacher_subject(teacher_id,subject_id )values(:lid,:subid)");
$query->bindParam(':lid',$LastInsertId,PDO::PARAM_STR);
$query->bindParam(':subid',$subid,PDO::PARAM_STR);
$query->execute();


echo '<script>alert("Teacher  has been added.")</script>';
echo "<script>window.location.href ='manage-teacher.php'</script>";
  }
  else
    {
         echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

  
}
else
{

echo "<script>alert('Teacher already registered');</script>";
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  
    <title>Time Table Generator : Add Teacher Information </title>

    <link href="../assets/css/lib/calendar2/pignose.calendar.min.css" rel="stylesheet">
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
                                <h1>Add Teacher</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="dashboard.php">Dashboard</a></li>
                                    <li class="active">Teacher Information</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <div id="main-content">
                    <div class="card alert">
                        <div class="card-body">
                            <form name="" method="post" action="" enctype="multipart/form-data">
                            <div class="card-header m-b-20">
                                <h4>Teacher Information</h4>
     
                            </div>
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Teacher Name</label>
                                            <input type="text" class="form-control border-none input-flat bg-ash" name="fname" required="true">
                                        </div>
                                    </div>
                                </div>
                 <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Subject</label>
                                            <select class="form-control border-none input-flat bg-ash" name="subid" required="true">
            <option value="">Select Subject</option>
            <?php
$sql="SELECT * from subjects";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
            <option value="<?php  echo htmlentities($row->id);?>"><?php  echo htmlentities($row->name);?></option><?php $cnt=$cnt+1;}} ?>
        </select>
                                        </div>
                                    </div>
                                </div>
                   
                            </div>
                            
                    
                 
                            <button class="btn btn-default btn-lg m-b-10 bg-warning border-none m-r-5 sbmt-btn" type="submit" name="submit">Save</button>
                            <button class="btn btn-default btn-lg m-b-10 m-l-5 sbmt-btn" type="reset">Reset</button>
                        </form>
                        </div>
                    </div>
                   
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


    <script src="../assets/js/lib/calendar-2/moment.latest.min.js"></script>
    <!-- scripit init-->
    <script src="../assets/js/lib/calendar-2/semantic.ui.min.js"></script>
    <!-- scripit init-->
    <script src="../assets/js/lib/calendar-2/prism.min.js"></script>
    <!-- scripit init-->
    <script src="../assets/js/lib/calendar-2/pignose.calendar.min.js"></script>
    <!-- scripit init-->
    <script src="../assets/js/lib/calendar-2/pignose.init.js"></script>
    <!-- scripit init-->

    <script src="../assets/js/scripts.js"></script>
</body>

</html><?php }  ?>