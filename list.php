<?php
session_start();
include_once 'database/connection.php';
include_once 'helper.php';

$conn = getConnection();


if (isset($_POST['add'])) {
    $item = $_POST['item'];
    $query = "insert into lists (item) values ('$item')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        message('Data inserted successfully');
        header('Location:index.php');
    } else {
        message('Fail to insert!');
        header('Location:index.php');
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $result = deleteItem($id);
    if ($result) {
        message("Data deleted successfully");
        header('Location:index.php');
    } else {
        message("No such user to delete!");
        header('Location:index.php');
    }
}


function deleteItem($id) {
    global $conn;
    if (is_numeric($id)) {
        $checkQuery = "select * from lists where id=$id";
        $result = mysqli_query($conn, $checkQuery);
        if (mysqli_num_rows($result) > 0) {
            $deleteQuery = "delete from lists where id=$id";
            return mysqli_query($conn, $deleteQuery);
        } else {
            return false;
        }
    } else {
        header('Location:index.php');
        exit();
    }
}
