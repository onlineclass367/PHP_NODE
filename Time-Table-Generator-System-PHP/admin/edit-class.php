<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['ttgaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {

$ttgaid=$_SESSION['ttgaid'];
$cname=$_POST['classname'];
$eid=$_GET['editid'];
$ret=$dbh->prepare("SELECT id FROM classes WHERE name=:cname");
$ret->bindParam(':cname',$cname,PDO::PARAM_STR);
$ret-> execute();
$results=$ret->fetchAll(PDO::FETCH_OBJ);
if($ret->rowCount() == 0){
$sql="update classes set name=:classname where id=:eid";
$query=$dbh->prepare($sql);
$query->bindParam(':classname',$cname,PDO::PARAM_STR);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
echo '<script>alert("Class has been updated")</script>';
echo "<script>window.location.href = 'class.php'</script>";  
} else {
echo '<script>alert("This class Already created.")</script>';
echo "<script>window.location.href ='class.php'</script>";
}}

?>
<!DOCTYPE html>
<html lang="en">

<head>
   
    <title>Time Table Generator : Class Update</title>

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
                                <h1>Class</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="dashboard.php">Dashboard</a></li>
                                    <li class="active">Class</li>
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
                                <div class="card-header pr">
                                    <h4>Update Class</h4>
                                    <form method="post" name="hjhgh">
                                        <?php
                   $eid=$_GET['editid'];
$sql="SELECT * from classes where id=$eid";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                                        <div class="basic-form m-t-20">
                                            <div class="form-group">
                                                <label>Class Name</label>
        <input type="text" class="form-control border-none input-flat bg-ash" value="<?php  echo htmlentities($row->name);?>" name="classname" required="true">
                                            </div>
                                        </div>
                                 
                                   
                                </div><?php $cnt=$cnt+1;}} ?> 
                                <button class="btn btn-default btn-lg m-b-10 bg-warning border-none m-r-5 sbmt-btn" type="submit" name="submit">Update</button>
                    
                            </form>
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