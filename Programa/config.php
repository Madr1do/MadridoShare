<?php
session_start();

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'enter_db_username';
$DATABASE_PASS = 'enter_db_password';
$DATABASE_NAME = 'enter_db_name';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Klaida: ' . mysqli_connect_error());
}?>;;
