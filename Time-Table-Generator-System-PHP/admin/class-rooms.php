<?php session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['ttgaid']==0)) {
  header('location:logout.php');
  } else{

if(isset($_POST['submit'])){
$ttgaid=$_SESSION['ttgaid'];
$crno=$_POST['classroomno'];

$ret=$dbh->prepare("SELECT id FROM classrooms WHERE room_no=:crno");
$ret->bindParam(':crno',$crno,PDO::PARAM_STR);
$ret-> execute();
$results=$ret->fetchAll(PDO::FETCH_OBJ);
if($ret->rowCount() == 0){

$sql="insert into classrooms(room_no)values(:crno)";
$query=$dbh->prepare($sql);
$query->bindParam(':crno',$crno,PDO::PARAM_STR);
$query->execute();
$LastInsertId=$dbh->lastInsertId();
if ($LastInsertId>0) {
echo '<script>alert("Class room has been added.")</script>';
echo "<script>window.location.href ='class-rooms.php'</script>";
  }else{
 echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }}
 else{
echo '<script>alert("This class Already created.")</script>';
echo "<script>window.location.href ='class-rooms.php'</script>";
}}
// Code for deletion
if(isset($_GET['delid']))
{
$rid=intval($_GET['delid']);
$sql="delete from classrooms where id=:rid";
$query=$dbh->prepare($sql);
$query->bindParam(':rid',$rid,PDO::PARAM_STR);
$query->execute();
 echo "<script>alert('Data deleted');</script>"; 
  echo "<script>window.location.href = 'class-rooms.php'</script>";     
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
   
    <title>Time Table Generator :  Create Classroom</title>

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
                                <h1>Classroom</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="dashboard.php">Dashboard</a></li>
                                    <li class="active">Classroom</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <div id="main-content">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card alert">
                                <div class="card-header pr">
                                    <h4>Create A New Classroom</h4>
                                    <form method="post" name="hjhgh">
                                        <div class="basic-form m-t-20">
                                            <div class="form-group">
                                                <label>Classroom Number</label>
        <input type="text" class="form-control border-none input-flat bg-ash" placeholder="Classroom No," name="classroomno" required="true">
                                            </div>
                                        </div>
                             
                                   
                                </div>
                                <button class="btn btn-default btn-lg m-b-10 bg-warning border-none m-r-5 sbmt-btn" type="submit" name="submit">Save</button>
                                <button class="btn btn-default btn-lg m-b-10 m-l-5 sbmt-btn" type="reset">Reset</button> 
                            </form>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card alert">
                                <div class="card-header pr">
                                    <h4>ALL Classrooms</h4>
                                    
                               
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table student-data-table m-t-20">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Classroom</th>
                                                    <th>Creation Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
$sql="SELECT * from classrooms";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                                                <tr>
                                                    <td><?php echo htmlentities($cnt);?></td>
                                                    <td>
                                                        <?php  echo htmlentities($row->room_no);?>
                                                    </td>
                                                    <td>
                                                        <?php  echo htmlentities($row->creationDate);?>
                                                    </td>
                                                    <td>
                                                <a href="class-rooms.php?delid=<?php echo ($row->id);?>"  onclick="return confirm('Do you really want to Delete ?');" class="btn btn-danger btn-xs">Delete</a>
                                                    </td>
                                                </tr>
                                                 <?php $cnt=$cnt+1;}} ?> 
                                            
                                             

                                            </tbody>
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