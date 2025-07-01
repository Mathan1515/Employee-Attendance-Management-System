<?php
$server = "localhost";
$username = "u639500956_employees";
$password = "eMp12345";
$database = "u639500956_employee";
$connection = mysqli_connect("$server","$username","$password");
$select_db = mysqli_select_db($connection, $database);
if(!$select_db)
{
	echo("connection terminated");
}

// Function to ensure upload directories exist
function ensureUploadDirectories() {
    $directories = [
        'uploads/profile_images/',
        '../uploads/profile_images/'
    ];
    
    foreach ($directories as $dir) {
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
    }
}

// Call the function when connection is established
ensureUploadDirectories();
?>