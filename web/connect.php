<?php
$mysql_link = new mysqli('localhost:3306', 'root', '', 'http_crowdsourcing');

if (mysqli_connect_error()) 
{
    die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
}
?>