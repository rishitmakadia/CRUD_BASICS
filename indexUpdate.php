<?php
header('Content-Type: application/json');

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'Test1';

$connection = mysqli_connect($server, $username, $password, $database);
if (!($connection)) {
    // die("No Connection Established " . mysqli_connect_error());
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['sno'])) {
    $sno = intval($_GET['sno']);
    $sql = "SELECT * FROM crud WHERE sno = $sno";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo json_encode(['success' => true, 'user' => $row]);
    } else {
        echo json_encode(['success' => false, 'message' => 'User not found']);
    }
    exit;
    // echo $html;
    // echo json_encode(['html' => $output]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sno'])) {
    $sno = intval($_POST['sno']);
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $position = $_POST['position'];
    $company = $_POST['company'];

    if (!empty($name) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $sql = "UPDATE crud SET 
                name = '$name', 
                email = '$email', 
                age = '$age', 
                position = '$position', 
                company = '$company' 
                WHERE sno = $sno";
        
        if (mysqli_query($connection, $sql)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Update failed: ' . mysqli_error($connection)]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid data']);
    }
    exit;
}
    // else {
    //     echo json_encode(['success' => false, 'message' => 'Invalid data']);
    // }

