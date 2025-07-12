<?php
// header('Content-Type: application/json');

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'Test1';

$connection = mysqli_connect($server, $username, $password, $database);
if (!($connection)) {
    die("No Connection Established " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = 'select * from crud order by sno';
    $result = mysqli_query($connection, $sql);
    $output = '';
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $output .= "<tr>
                <td>{$row['sno']}</td>
                <td>{$row['name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['age']}</td>
                <td>{$row['position']}</td>
                <td>{$row['company']}</td>
                <td>{$row['timestamp']}</td>
                <td>
                <button class='btn btn-sm btn-warning editBtn' data-id='{$row['sno']}'>Edit</button>
                <button class='btn btn-sm btn-danger deleteBtn' data-id='{$row['sno']}'>Delete</button>
                </td>
                </tr>";
            }
        }
        // echo $html;
        echo json_encode(['html' => $output]);
    }
    