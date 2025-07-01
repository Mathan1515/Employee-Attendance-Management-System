<?php
session_start();
if (empty($_SESSION['name'])) {
    header('location:index.php');
    exit;
}

include('includes/connection.php');

$id = $_SESSION['id'];
$fetch_data = mysqli_query($connection, "SELECT * FROM tbl_employee WHERE id='$id'");
$res = mysqli_fetch_array($fetch_data);

// Make employee data available for header
$_SESSION['employee_name'] = $res['first_name'] . " " . $res['last_name'];

// Set default profile image path
$default_image = 'assets/img/user.jpg';
$profile_image = $default_image;

// Check if user has a profile image
if (!empty($res['profile_image'])) {
    $image_path = $res['profile_image'];
    // Convert admin path to employee path if needed
    if (strpos($image_path, '../uploads/') === 0) {
        $image_path = str_replace('../uploads/', 'uploads/', $image_path);
    }
    if (file_exists($image_path)) {
        $profile_image = $image_path;
    }
}

$_SESSION['profile_image'] = $profile_image;

include('header.php');
?>

<div class="page-wrapper">
    <div class="content container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-gradient-primary text-white position-relative py-4">
                        <div class="text-center">
                            <div class="profile-image-container mb-3">
                                <img src="<?php echo htmlspecialchars($profile_image); ?>" 
                                     alt="Profile Image" 
                                     class="rounded-circle border border-4 border-white shadow" 
                                     width="160" 
                                     height="160" 
                                     style="object-fit: cover;">
                            </div>
                            <h3 class="mb-0 fw-bold"><?php echo htmlspecialchars($res['first_name'] . " " . $res['last_name']); ?></h3>
                            <p class="text-white-50"><?php echo htmlspecialchars($res['department']); ?></p>
                            <div class="mt-3">
                                <?php
                                // Generate QR code for full employee details as plain text (for ID card QR scanning)
                                // If you scan this QR code with Google Lens or any QR scanner, you should see all employee details in text format.
                                // If you do not see the details, make sure to reload this page after any code update and reprint the QR code.
                                include_once('assets/phpqrcode/qrlib.php');
                                $qrTempDir = sys_get_temp_dir();
                                $qrFileName = $qrTempDir . DIRECTORY_SEPARATOR . 'empqr_' . $res['employee_id'] . '.png';
                                $empText =
                                    "Employee ID: {$res['employee_id']}\n\n" .
                                    "Username: {$res['username']}\n\n" .
                                    "Name: {$res['first_name']} {$res['last_name']}\n\n" .
                                    "Department: {$res['department']}\n\n" .
                                    "Email: {$res['emailid']}\n\n" .
                                    "Phone: {$res['phone']}\n\n" .
                                    "Gender: {$res['gender']}\n\n" .
                                    "Date of Birth: {$res['dob']}\n\n" .
                                    "Joining Date: {$res['joining_date']}\n\n" .
                                    "Shift: {$res['shift']}\n\n" .
                                    "Status: {$res['status']}";
                                QRcode::png($empText, $qrFileName, QR_ECLEVEL_L, 8);
                                $qrBase64 = base64_encode(file_get_contents($qrFileName));
                                ?>
                                <img id="empQrImg" src="data:image/png;base64,<?php echo $qrBase64; ?>" alt="Employee QR Code" width="220" height="220">
                                <br>
                                <button class="btn btn-primary mt-3" onclick="downloadQrCode()">Download QR Code</button>
                                <script>
                                function downloadQrCode() {
                                    var img = document.getElementById('empQrImg');
                                    var url = img.src;
                                    var a = document.createElement('a');
                                    a.href = url;
                                    a.download = 'employee_qr_<?php echo $res['employee_id']; ?>.png';
                                    document.body.appendChild(a);
                                    a.click();
                                    document.body.removeChild(a);
                                }
                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h4 class="text-primary">Personal Information</h4>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            
                            <div class="col-md-6 mb-3">
                                <div class="info-card p-3 bg-light rounded">
                                    <div class="info-label text-muted small">Full Name</div>
                                    <div class="info-value fw-bold"><?php echo htmlspecialchars($res['first_name'] . " " . $res['last_name']); ?></div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="info-card p-3 bg-light rounded">
                                    <div class="info-label text-muted small">Employee ID</div>
                                    <div class="info-value fw-bold"><?php echo htmlspecialchars($res['employee_id']); ?></div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="info-card p-3 bg-light rounded">
                                    <div class="info-label text-muted small">Email</div>
                                    <div class="info-value fw-bold"><?php echo htmlspecialchars($res['emailid']); ?></div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="info-card p-3 bg-light rounded">
                                    <div class="info-label text-muted small">Phone</div>
                                    <div class="info-value fw-bold"><?php echo htmlspecialchars($res['phone']); ?></div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="info-card p-3 bg-light rounded">
                                    <div class="info-label text-muted small">D.O.B</div>
                                    <div class="info-value fw-bold"><?php echo htmlspecialchars($res['dob']); ?></div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="info-card p-3 bg-light rounded">
                                    <div class="info-label text-muted small">Joining Date</div>
                                    <div class="info-value fw-bold"><?php echo htmlspecialchars($res['joining_date']); ?></div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="info-card p-3 bg-light rounded">
                                    <div class="info-label text-muted small">Department</div>
                                    <div class="info-value fw-bold"><?php echo htmlspecialchars($res['department']); ?></div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="info-card p-3 bg-light rounded">
                                    <div class="info-label text-muted small">Shift</div>
                                    <div class="info-value fw-bold"><?php echo htmlspecialchars($res['shift']); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
    }
    
    .profile-image-container {
        position: relative;
        display: inline-block;
    }
    
    .info-card {
        transition: all 0.3s ease;
    }
    
    .info-card:hover {
        background-color: #f8f9fa !important;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }
</style>

<?php include('footer.php'); ?>