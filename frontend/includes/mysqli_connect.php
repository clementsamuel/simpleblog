<?php 
// This creates a connection to the birdsdb database, it also sets the encoding to utf-8.
// Set the access details as constants:
DEFINE ('DB_USER', 'clement');
DEFINE ('DB_PASSWORD', 'samuel');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'blog');
// Make the connection:
$dbcon = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );
// Set the encoding
mysqli_set_charset($dbcon, 'utf8');