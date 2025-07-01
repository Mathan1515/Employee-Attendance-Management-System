<?php
session_start();
if(empty($_SESSION['name']))
{
    header('location:index.php');
    exit;
}

include('includes/connection.php');

// Check if report parameters exist in session
if(!isset($_SESSION['report_from_date']) || !isset($_SESSION['report_to_date']) || !isset($_SESSION['report_department'])) {
    header('location:report.php');
    exit;
}

// Get report parameters from session
$from_date = $_SESSION['report_from_date'];
$to_date = $_SESSION['report_to_date'];
$dept = $_SESSION['report_department'];

// Convert dates to Y-m-d format for database query
$from_date_db = date('Y-m-d', strtotime($from_date));
$to_date_db = date('Y-m-d', strtotime($to_date));

// Set headers for Excel download
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="employee_report_' . date('Y-m-d') . '.xls"');
header('Pragma: no-cache');
header('Expires: 0');

// Query to get data
$search_query = mysqli_query($connection, "select tbl_employee.first_name, tbl_employee.last_name, tbl_employee.department, tbl_attendance.date, tbl_attendance.shift, tbl_attendance.check_in, tbl_attendance.work_report, tbl_attendance.in_status, tbl_attendance.check_out, tbl_attendance.out_status from tbl_employee inner join tbl_attendance on tbl_attendance.employee_id=tbl_employee.employee_id where tbl_attendance.department='$dept' and DATE(tbl_attendance.date) BETWEEN '$from_date_db' and '$to_date_db'");

// Create Excel content
echo '
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Employee Report</title>
</head>
<body>
    <h2>Employee Report</h2>
    <p>Department: ' . $dept . '</p>
    <p>Period: ' . $from_date . ' to ' . $to_date . '</p>
    
    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Department</th>
                <th>Date</th>
                <th>Shift</th>
                <th>Check In</th>
                <th>In Status</th>
                <th>Check Out</th>
                <th>Out Status</th>
                <th>Total Working Hours</th>
                <th>Work Report</th>
            </tr>
        </thead>
        <tbody>';

// Add data rows
while($row = mysqli_fetch_array($search_query)) {
    // Calculate total working hours
    $check_in = $row['check_in'];
    $check_out = $row['check_out'];
    $total_working_hours = '';
    if ($check_in && $check_out && $check_in != '00:00:00' && $check_out != '00:00:00') {
        $in = new DateTime($check_in);
        $out = new DateTime($check_out);
        $interval = $in->diff($out);
        $total_working_hours = $interval->format('%h:%I');
    }
    echo '<tr>
            <td>' . $row['first_name'] . ' ' . $row['last_name'] . '</td>
            <td>' . $row['department'] . '</td>
            <td>' . $row['date'] . '</td>
            <td>' . $row['shift'] . '</td>
            <td>' . $row['check_in'] . '</td>
            <td>' . $row['in_status'] . '</td>
            <td>' . $row['check_out'] . '</td>
            <td>' . $row['out_status'] . '</td>
            <td>' . $total_working_hours . '</td>
            <td>' . $row['work_report'] . '</td>
        </tr>';
}

echo '  </tbody>
    </table>
</body>
</html>';

exit;
?>