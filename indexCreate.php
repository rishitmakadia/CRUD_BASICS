<?php

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'Test1';

$connection = mysqli_connect($server, $username, $password, $database);
if (!($connection)) {
    die("No Connection Established " . mysqli_connect_error());
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $position = $_POST['position']; 
    $company = $_POST['company'];
    if (!empty($name) && !empty($email) && !empty($age) && !empty($position) && !empty($company)&& filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // $sql = "INSERT INTO `crud` (`name`, `email`, `age`, `position`, `company`, `timestamp`) VALUES ('$name', '$email', '$age', '$position', '$company', current_timestamp());";
        $sql = "INSERT INTO crud (name, email, age, position, company, timestamp)
                VALUES ('$name', '$email', '$age', '$position', '$company', CURRENT_TIMESTAMP())";
        // $result = mysqli_query($connection, $sql);
        mysqli_query($connection, $sql);
    }
    // echo $html;
}
?>