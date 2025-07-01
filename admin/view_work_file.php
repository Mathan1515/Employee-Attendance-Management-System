<?php 
session_start(); 
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(empty($_SESSION['name'])) {     
    header('location:index.php');     
    exit; 
}  

// Basic security check - validate file parameter exists
if(!isset($_GET['file']) || empty($_GET['file'])) {     
    die("Error: No file specified"); 
}  

// URL decode the file parameter
$file = urldecode($_GET['file']);

// For debugging - show the requested file path
echo "Requested file: " . $file . "<br>";

// Construct file paths to try
$paths_to_try = array(
    "../" . $file,                        // Standard relative path with ../
    $file,                                // Direct path as provided
    "../uploads/work_reports/" . basename($file), // Just the filename in the upload dir
    "../../uploads/work_reports/" . basename($file), // Try one directory level up
    "../../../uploads/work_reports/" . basename($file) // Try two directory levels up
);

$file_found = false;
$file_path = '';

// Try each path
foreach ($paths_to_try as $path) {
    echo "Checking path: " . $path . "<br>";
    
    if (file_exists($path)) {
        $file_path = $path;
        $file_found = true;
        echo "File found at: " . $path . "<br>";
        break;
    }
}

// If file not found, check if directory exists
if (!$file_found) {
    $dir = "../uploads/work_reports/";
    if (!is_dir($dir)) {
        echo "Directory not found: " . $dir . "<br>";
        
        // Check if parent directories exist
        $parent_dir = "../uploads/";
        if (!is_dir($parent_dir)) {
            echo "Parent directory not found: " . $parent_dir . "<br>";
        } else {
            echo "Parent directory exists: " . $parent_dir . "<br>";
        }
        
        die("Error: Cannot find file or directory");
    } else {
        echo "Directory exists: " . $dir . "<br>";
        
        // List files in directory to help debugging
        echo "Files in directory:<br>";
        $files = scandir($dir);
        foreach ($files as $f) {
            if ($f != "." && $f != "..") {
                echo "- " . $f . "<br>";
            }
        }
        
        die("Error: File not found in any of the expected locations");
    }
}

// If we reach here, file was found
$file_ext = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));  

// Set appropriate content type based on file extension
$content_types = [     
    'pdf' => 'application/pdf',     
    'doc' => 'application/msword',     
    'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',     
    'xls' => 'application/vnd.ms-excel',     
    'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',     
    'csv' => 'text/csv',     
    'txt' => 'text/plain',     
    'jpg' => 'image/jpeg',     
    'jpeg' => 'image/jpeg',     
    'png' => 'image/png' 
];  

// Clean output buffer to ensure headers can be sent
ob_clean();

// Set content type header
if(isset($content_types[$file_ext])) {     
    header('Content-Type: ' . $content_types[$file_ext]); 
} else {     
    header('Content-Type: application/octet-stream'); 
}  

// Set content disposition header for certain file types
if(in_array($file_ext, ['pdf', 'jpg', 'jpeg', 'png'])) {     
    // Display in browser     
    header('Content-Disposition: inline; filename="' . basename($file_path) . '"'); 
} else {     
    // Force download for other file types     
    header('Content-Disposition: attachment; filename="' . basename($file_path) . '"'); 
}  

header('Content-Length: ' . filesize($file_path)); 

// Output file contents
readfile($file_path); 
exit;
?>