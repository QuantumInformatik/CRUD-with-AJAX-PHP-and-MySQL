<?php 
$bd = new PDO('mysql:host=localhost;dbname=crud','root','putas-1997');

$bd->query("TRUNCATE tblproductos");

header("location:../index.php"); 
?> 