<?php
session_start();

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'maoweb_share';
$DATABASE_PASS = 'LKJNiuygsc7t3y7fygehsd';
$DATABASE_NAME = 'maoweb_share';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Klaida: ' . mysqli_connect_error());
}?>
