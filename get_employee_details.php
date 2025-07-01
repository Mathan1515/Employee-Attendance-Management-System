<?php
include('includes/connection.php');
header('Content-Type: application/json');

$id = isset($_GET['id']) ? mysqli_real_escape_string($connection, $_GET['id']) : '';
if (!$id) {
    echo json_encode(['status' => 'error', 'message' => 'No ID provided']);
    exit;
}

// Try to fetch by employee_id (not DB id)
$query = mysqli_query($connection, "SELECT * FROM tbl_employee WHERE employee_id='$id' LIMIT 1");
if (!$query || mysqli_num_rows($query) == 0) {
    echo json_encode(['status' => 'error', 'message' => 'Employee not found']);
    exit;
}
$row = mysqli_fetch_assoc($query);

// Handle profile image path
$default_image = 'assets/img/user.jpg';
$profile_image = $default_image;
if (!empty($row['profile_image'])) {
    $image_path = $row['profile_image'];
    if (strpos($image_path, '../uploads/') === 0) {
        $image_path = str_replace('../uploads/', 'uploads/', $image_path);
    }
    if (file_exists($image_path)) {
        $profile_image = $image_path;
    }
}

// Return details
$data = [
    'first_name' => $row['first_name'],
    'last_name' => $row['last_name'],
    'employee_id' => $row['employee_id'],
    'username' => $row['username'],
    'department' => $row['department'],
    'emailid' => $row['emailid'],
    'phone' => $row['phone'],
    'gender' => $row['gender'],
    'dob' => $row['dob'],
    'joining_date' => $row['joining_date'],
    'shift' => $row['shift'],
    'status' => $row['status'],
    'profile_image' => $profile_image
];
echo json_encode($data); 