<?php

// if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])) {
//     //header( 'location: https://ilimi.org/');
//     echo "I thnik it worked";
// }

// this file should be named database_inc.php
$connect = mysqli_connect("localhost","root","free97voice", "csia");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>