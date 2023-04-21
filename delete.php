<?php
//initialize session
session_start();

// PHP charset
ini_set('default_charset', 'UTF-8');

if( $_SESSION['login'] == TRUE){

    // database connection
    include ("db_connect.php");
    $query = "DELETE FROM contatos WHERE codigo=$_GET[codigo]";
    mysqli_query ($conn, $query);
    // close connection
    mysqli_close ($conn);
    // redirect to page list
    header("location: read.php");
    
} else {
    header ('Location: login.php');
  } 
?>