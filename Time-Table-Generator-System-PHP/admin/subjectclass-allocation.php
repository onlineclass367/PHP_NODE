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
$cid=$_POST['cid'];
$subject=$_POST['subject'];
 $ret=$dbh->prepare("SELECT id FROM class_subject WHERE class_id=:cid and subject_id=:subject");
$ret->bindParam(':cid',$cid,PDO::PARAM_STR);
$ret->bindParam(':subject',$subject,PDO::PARAM_STR);
$ret-> execute();
$results=$ret->fetchAll(PDO::FETCH_OBJ);
if($ret->rowCount() == 0){

$sql="insert into class_subject(class_id, subject_id )values(:cid,:subject)";
$query=$dbh->prepare($sql);
$query->bindParam(':cid',$cid,PDO::PARAM_STR);
$query->bindParam(':subject',$subject,PDO::PARAM_STR);
 $query->execute();

   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
    echo '<script>alert("Class Subject allocation has been done.")</script>';
echo "<script>window.location.href ='subjectclass-allocation.php'</script>";
  }else{
         echo '<script>alert("Something Went Wrong. Please try again")</script>';
    } } else{
echo '<script>alert("This subject already allocated to this class.")</script>';
echo "<script>window.location.href ='subjectclass-allocation.php'</script>";
}

  
}
// Code for deleting product
if(isset($_GET['delid']))
{
$rid=intval($_GET['delid']);
$sql="delete from class_subject where id=:rid";
$query=$dbh->prepare($sql);
$query->bindParam(':rid',$rid,PDO::PARAM_STR);
$query->execute();
 echo "<script>alert('Data deleted');</script>"; 
  echo "<script>window.location.href = 'subjectclass-allocation.php'</script>";     


}

?>
<!DOCTYPE html>
<html lang="en">

<head>
   
    <title>Time Table Generator : Subject Allocation</title>

       <!-- Styles -->
    <link href="../assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="../assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="../assets/css/lib/menubar/sidebar.css" rel="stylesheet">
    <link href="../assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/lib/unix.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <script>
function getteacher(val) {
$.ajax({
type: "POST",
url: "get_teacher.php",
data:'courseid='+val,
success: function(data){
$("#teachereid").html(data);
}
});

$.ajax({
        type: "POST",
        url: "get_teacher.php",
        data:'cid='+val,
        success: function(data){
        $("#subject").html(data); 
        }
        });


}
</script>

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
                                <h1>Class Subject Allocation</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="dashboard.php">Dashboard</a></li>
                                    <li class="active">Class Subject Allocation</li>
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
                                    <h4>Class Subject Allocation</h4>
                                    <form method="post" name="hjhgh">
                                        <div class="basic-form m-t-20">
                                            <div class="form-group">
                                                <label>Class</label>
  <select class="form-control border-none input-flat bg-ash" name="cid" id="cid" required="true">
            <option value="">Select Class</option>
            <?php
$sql="SELECT * from classes";
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


<div class="basic-form m-t-20">
 <div class="form-group">
 <label>Subject</label>
<select class="form-control border-none input-flat bg-ash" name="subject" id="subject" required="true">
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
                                <button class="btn btn-default btn-lg m-b-10 bg-warning border-none m-r-5 sbmt-btn" type="submit" name="submit">Save</button>
                                <button class="btn btn-default btn-lg m-b-10 m-l-5 sbmt-btn" type="reset">Reset</button> 
                            </form>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card alert">
                                <div class="card-header pr">
                                    <h4>Class Subject Allocation Details</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table student-data-table m-t-20">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Class Name</th>
                                                    <th>Subject Name</th>
                                                    <th>Allocation Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
$sql="SELECT classes.name as classname,subjects.name as subjectname,class_subject.allocationDate,class_subject.id as rid FROM `class_subject` join classes on classes.id=class_subject.class_id join subjects on subjects.id=class_subject.subject_id";
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
                                                    <td><?php  echo htmlentities($row->classname);?> </td>
                                                    <td><?php  echo htmlentities($row->subjectname);?></td>
                                                   <td><?php  echo htmlentities($row->allocationDate);?></td>
                                                    <td>
                                                       
                                                      
                                                        <span><a href="subjectclass-allocation.php?delid=<?php echo ($row->rid);?>"  onclick="return confirm('Do you really want to Delete ?');" class="btn btn-danger btn-xs">DELETE </a></span>
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