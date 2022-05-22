<?php

include "../config.php"; // Using database connection file here
include '../../loggedin.php';
$id = $_GET['id']; // get id through query string

$del = mysqli_query($con,"delete from skelbimai where id = '$id'"); // delete query

if($del)
{
    mysqli_close($con); // Close connection
    header("Location: home"); // redirects to all records page
    exit;
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
?>
