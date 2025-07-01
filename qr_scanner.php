<?php
// qr_scanner.php
session_start();
include('includes/connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee QR Scanner</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <style>
        #reader { width: 350px; margin: 0 auto; }
        .emp-details { margin-top: 30px; }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Scan Employee QR Code</h2>
    <div id="reader"></div>
    <div id="emp-details" class="emp-details"></div>
</div>
<script>
function showEmployeeDetails(data) {
    if (!data || data.status === 'error') {
        document.getElementById('emp-details').innerHTML = '<div class="alert alert-danger">Employee not found.</div>';
        return;
    }
    let html = `<div class='card'><div class='card-body'>
        <h4 class='card-title mb-3'>${data.first_name || ''} ${data.last_name || ''}</h4>
        <ul class='list-group list-group-flush'>
            <li class='list-group-item'><strong>Employee ID:</strong> ${data.employee_id || ''}</li>
            <li class='list-group-item'><strong>Username:</strong> ${data.username || ''}</li>
            <li class='list-group-item'><strong>Department:</strong> ${data.department || ''}</li>
            <li class='list-group-item'><strong>Email:</strong> <a href='mailto:${data.emailid || ''}'>${data.emailid || ''}</a></li>
            <li class='list-group-item'><strong>Phone:</strong> <a href='tel:${data.phone || ''}'>${data.phone || ''}</a></li>
            <li class='list-group-item'><strong>Gender:</strong> ${data.gender || ''}</li>
            <li class='list-group-item'><strong>Date of Birth:</strong> ${data.dob || ''}</li>
            <li class='list-group-item'><strong>Joining Date:</strong> ${data.joining_date || ''}</li>
            <li class='list-group-item'><strong>Shift:</strong> ${data.shift || ''}</li>
            <li class='list-group-item'><strong>Status:</strong> ${data.status || ''}</li>
        </ul>
    </div></div>`;
    document.getElementById('emp-details').innerHTML = html;
}

function parsePlainTextEmployeeDetails(text) {
    // Parse plain text QR code (label: value)\n format
    let lines = text.split(/\r?\n/);
    let data = {};
    lines.forEach(line => {
        let idx = line.indexOf(":");
        if (idx > -1) {
            let key = line.slice(0, idx).trim().toLowerCase().replace(/ /g, '_');
            let value = line.slice(idx + 1).trim();
            data[key] = value;
        }
    });
    // Map to expected keys for display
    return {
        first_name: (data['name'] || '').split(' ')[0] || '',
        last_name: (data['name'] || '').split(' ').slice(1).join(' ') || '',
        employee_id: data['employee_id'] || '',
        username: data['username'] || '',
        department: data['department'] || '',
        emailid: data['email'] || '',
        phone: data['phone'] || '',
        gender: data['gender'] || '',
        dob: data['date_of_birth'] || '',
        joining_date: data['joining_date'] || '',
        shift: data['shift'] || '',
        status: data['status'] || ''
    };
}

function fetchEmployeeDetails(empId) {
    fetch('get_employee_details.php?id=' + encodeURIComponent(empId))
        .then(response => response.json())
        .then(data => showEmployeeDetails(data))
        .catch(() => showEmployeeDetails({status: 'error'}));
}

const html5QrCode = new Html5Qrcode("reader");
Html5Qrcode.getCameras().then(devices => {
    if (devices && devices.length) {
        html5QrCode.start(
            { facingMode: "environment" },
            { fps: 10, qrbox: 250 },
            qrCodeMessage => {
                html5QrCode.stop();
                let trimmed = qrCodeMessage.trim();
                // Try to parse as plain text employee details
                if (/Employee ID:/i.test(trimmed) && /Name:/i.test(trimmed)) {
                    let empData = parsePlainTextEmployeeDetails(trimmed);
                    showEmployeeDetails(empData);
                    return;
                }
                // Fallback: treat as employee_id
                fetchEmployeeDetails(trimmed);
            },
            errorMessage => {
                // ignore errors
            })
    }
}).catch(err => {
    document.getElementById('emp-details').innerHTML = '<div class="alert alert-danger">Camera not found or not accessible.</div>';
});
</script>
</body>
</html> 