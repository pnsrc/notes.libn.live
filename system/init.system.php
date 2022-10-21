<?php 
require 'rb.php';
require "module/parsedown/md.php";
R::setup( 'mysql:host=localhost;dbname=alenich','root', '' ); 

if ( !R::testconnection() )
{
		exit ('Нет соединения с базой данных');
}

// We adding parsedown
$Parsedown = new Parsedown();
session_start();