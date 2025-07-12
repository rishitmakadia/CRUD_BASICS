<?php

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'Test1';

$connection = mysqli_connect($server, $username, $password, $database);
if (!($connection)) {
    die("No Connection Established " . mysqli_connect_error());
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sno'])) {
    $no = intval($_POST['sno']);
    //DELETE FROM `crud` WHERE `crud`.`sno` = 20
    $sql = "DELETE FROM `crud` WHERE `crud`.`sno` = $no";
    // $result = mysqli_query($connection, $sql);
    mysqli_query($connection, $sql);
    // echo $html;
}
?>