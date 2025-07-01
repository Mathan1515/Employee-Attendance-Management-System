<?php
session_start();
error_reporting(0);
if(empty($_SESSION['name']))
{
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');
$id = $_SESSION['id'];
$fetch_query = mysqli_query($connection, "select shift from tbl_employee where id='$id'");
$shift = mysqli_fetch_array($fetch_query);

$fetch_emp = mysqli_query($connection, "select * from tbl_employee where id='$id'");
$emp = mysqli_fetch_array($fetch_emp);
$empid = $emp['employee_id'];
$dept = $emp['department'];

$curr_date = date('Y-m-d');
date_default_timezone_set('Asia/Kolkata'); 
$time = date('Y-m-d H:i:s');
$intime = "";
$outtime = "";
$checkout_status='';
$shifttime = $shift['shift']; 
$shifttime = substr($shifttime, 0,8);
if(time()>strtotime($shifttime))
{
  $intime = "Late";
}
else
{
  $intime = "On Time";
} 

$outtimeshift = $shift['shift'];
$outtimeshift = substr($outtimeshift, -8);

if(time()>strtotime($outtimeshift))
{
  $outtime = "Over Time";
}
else
{
  $outtime = "Early";
}


    if(isset($_REQUEST['turn-it']))
    {
      $shift = $shift['shift'];
      $department = $dept;
      $location = $_REQUEST['location'];
      $msg = $_REQUEST['msg'];
      $emp_id = $empid;
      $date = $curr_date;
      $check_in = $time;
      $in_status = $intime;
      

      
      $insert_query = mysqli_query($connection, "insert into tbl_attendance set employee_id='$emp_id', department='$department', shift='$shift', location='$location', message='$msg', date='$date',  check_in='$check_in', in_status='$in_status'");

    }
    
    // Handle file upload and work report submission
    if(isset($_REQUEST['check-out']))
    {
      $check_out = $time;
      $work_report = $_POST['work_report'] ? mysqli_real_escape_string($connection, $_POST['work_report']) : '';
      
      // Handle file upload if a file was submitted
      $file_path = '';
      $upload_status = '';
      
      if(!empty($_FILES['work_file']['name'])) {
          $upload_dir = '../uploads/work_reports/';
          
          // Create directory if it doesn't exist
          if (!file_exists($upload_dir)) {
              mkdir($upload_dir, 0777, true);
          }
          
          // Get file extension
          $file_extension = strtolower(pathinfo($_FILES['work_file']['name'], PATHINFO_EXTENSION));
          
          // Define allowed file types
          $allowed_extensions = array('pdf', 'doc', 'docx', 'xls', 'xlsx', 'jpg', 'jpeg', 'png', 'txt');
          
          // Validate file type
          if(in_array($file_extension, $allowed_extensions)) {
              // Create unique filename to prevent overwriting
              $file_name = date('Ymd') . '_' . $empid . '_' . uniqid() . '_' . basename($_FILES['work_file']['name']);
              $file_path = $upload_dir . $file_name;
              
              // Check file size (limit to 10MB)
              if($_FILES['work_file']['size'] <= 10485760) { // 10MB in bytes
                  // Move uploaded file
                  if(move_uploaded_file($_FILES['work_file']['tmp_name'], $file_path)) {
                      // File uploaded successfully
                      $upload_status = 'success';
                  } else {
                      // File upload failed
                      $file_path = '';
                      $upload_status = 'error_upload';
                  }
              } else {
                  $file_path = '';
                  $upload_status = 'error_size';
              }
          } else {
              $file_path = '';
              $upload_status = 'error_type';
          }
      }
      
      // Update attendance record with checkout info and file path
      $insert_query = mysqli_query($connection, "update tbl_attendance set check_out='$check_out', out_status='$outtime', work_report='$work_report', work_file='$file_path' where employee_id='$empid' and date='$curr_date'");
      $checkout_status = 0; 
    }
?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 ">
                        <h4 class="page-title">Attendance Form</h4>
                         
                    </div>
                    
                </div>
                <div class="row">
                  <?php
                   $date = date('Y-m-d');
                   $fetch_attend = mysqli_query($connection,"select employee_id from tbl_attendance where date='$date' and employee_id='$empid'");
                  $row = mysqli_num_rows($fetch_attend);
                  if($row==0){
                   ?>
                    <div class="col-lg-8 offset-lg-2">
                       <form method="post">
                            <div class="row">
                              <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Shift <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="shift" value="<?php echo $shift['shift']; ?>" disabled>
                                          
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Location <span class="text-danger">*</span></label>
                                        <select class="select" name="location" required>
                                            <option value="">Select</option>
                                            <?php
                                             $fetch_query = mysqli_query($connection, "select location from tbl_location");
                                                while($loc = mysqli_fetch_array($fetch_query)){ 
                                            ?>
                                            <option value="<?php echo $loc['location']; ?>"><?php echo $loc['location']; ?></option>
                                            <?php } ?>
                                            
                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Message </label>
                                        <textarea class="form-control" name="msg"></textarea>  
                                          
                                    </div>
                                </div> -->
                               
                    </div>
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn" name="turn-it"><img src="assets/img/login.png" width="40"> Login...</button>
                            </div>
                        </form>
                    </div>
                  <?php } else {
                    
                    $fetch_checkin = mysqli_query($connection,"select date from tbl_attendance where check_out='00:00:00' and employee_id='$empid'");
                    $rows = mysqli_num_rows($fetch_checkin);
                    if($rows>0){
                    $data = mysqli_fetch_array($fetch_checkin);
                    $chekdate = $data['date'];
                    }
                    
                    $curr_date = date('Y-m-d');
                    $fetch_checkout = mysqli_query($connection,"select out_status from tbl_attendance where date='$curr_date' and employee_id='$empid'");
                    $result = mysqli_fetch_array($fetch_checkout);
                    $result = $result['out_status'];
                    ?>
                    
                   <div class="col-lg-8 offset-lg-2">
                       <div class="row">
                          <div class="col-sm-12">
                            <center><h3>Thank You For Today</h3></center>
                            <form method="post" enctype="multipart/form-data">
                              <?php if($result=='' || $checkout_status==1){ ?>
                              <!-- Work report section - only shown before checkout -->
                              <div class="card mb-4">
                                <div class="card-header">
                                  <h4>Report Today's Work</h4>
                                </div>
                                <div class="card-body">
                                  <div class="form-group">
                                    <label>Work Summary <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="work_report" rows="5" placeholder="Please summarize your work for today (Heading Only: Full detalis upload file )" required></textarea>
                                  </div>
                                  <div class="form-group">
                                    <label>Upload Work File (Optional)</label>
                                    <input type="file" name="work_file" class="form-control" required>
                                    <small class="text-muted">Upload documents, reports, PDFs, images or any file related to your work today (Max 10MB)</small>
                                  </div>
                                  
                                  <?php if(isset($upload_status)): ?>
                                  <div class="mt-3">
                                    <?php if($upload_status == 'success'): ?>
                                      <div class="alert alert-success">File uploaded successfully!</div>
                                    <?php elseif($upload_status == 'error_type'): ?>
                                      <div class="alert alert-danger">Invalid file type. Allowed types: PDF, DOC, DOCX, XLS, XLSX, JPG, JPEG, PNG, TXT</div>
                                    <?php elseif($upload_status == 'error_size'): ?>
                                      <div class="alert alert-danger">File size is too large. Maximum size: 10MB</div>
                                    <?php elseif($upload_status == 'error_upload'): ?>
                                      <div class="alert alert-danger">Failed to upload file. Please try again.</div>
                                    <?php endif; ?>
                                  </div>
                                  <?php endif; ?>
                                </div>
                              </div>
                              
                              <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn" name="check-out" onclick="return confirmDelete()"><img src="assets/img/login.png" width="40"> LogOut...!</button>
                              </div>
                              <?php } else { ?>
                              <div class="alert alert-success text-center mt-4">
                                <h4><i class="fa fa-check-circle"></i> You have Logout for today!</h4>
                                <h5>See you tomorrow!</h5>
                              </div>
                              <?php } ?>
                            </form>
                          </div>
                        </div>
                      </div>
                   
                  <?php } ?>

                </div>
            </div>
		</div>
    
<?php
    include('footer.php');
?>
<script language="JavaScript" type="text/javascript">
function confirmDelete(){
    return confirm('Are you sure you want to check out now?');
}
</script>