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

// Query to get data
$search_query = mysqli_query($connection, "select tbl_employee.first_name, tbl_employee.last_name, tbl_employee.department, tbl_attendance.date, tbl_attendance.shift, tbl_attendance.check_in, tbl_attendance.work_report, tbl_attendance.work_file, tbl_attendance.in_status, tbl_attendance.check_out, tbl_attendance.out_status from tbl_employee inner join tbl_attendance on tbl_attendance.employee_id=tbl_employee.employee_id where tbl_attendance.department='$dept' and DATE(tbl_attendance.date) BETWEEN '$from_date_db' and '$to_date_db'");

// Prepare PDF content
$html = '
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Employee Attendance Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1, h3 {
            text-align: center;
            margin-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
            font-size: 12px;
        }
        th {
            background-color: #f2f2f2;
        }
        .report-info {
            text-align: center;
            margin-bottom: 20px;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="no-print">
        <button onclick="window.print()">Print this report</button>
        <button onclick="window.close()">Close</button>
    </div>
    
    <h1>Employee Attendance Report</h1>
    <div class="report-info">
        <h3>Department: ' . htmlspecialchars($dept) . '</h3>
        <h3>Period: ' . htmlspecialchars($from_date) . ' to ' . htmlspecialchars($to_date) . '</h3>
    </div>
    
    <table>
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
    $html .= '
            <tr>
                <td>' . htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) . '</td>
                <td>' . htmlspecialchars($row['department']) . '</td>
                <td>' . htmlspecialchars($row['date']) . '</td>
                <td>' . htmlspecialchars($row['shift']) . '</td>
                <td>' . htmlspecialchars($row['check_in']) . '</td>
                <td>' . htmlspecialchars($row['in_status']) . '</td>
                <td>' . htmlspecialchars($row['check_out']) . '</td>
                <td>' . htmlspecialchars($row['out_status']) . '</td>
                <td>' . htmlspecialchars($total_working_hours) . '</td>
                <td>' . htmlspecialchars($row['work_report']) . '</td>
            </tr>';
}

$html .= '
        </tbody>
    </table>
    
    <script>
        // Auto print when the page loads
        window.onload = function() {
            // Uncomment the line below if you want it to automatically print
            // window.print();
        }
    </script>
</body>
</html>';

// Output the HTML content
echo $html;
exit;
?>