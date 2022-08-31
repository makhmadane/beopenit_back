<?php

$serveur="localhost";
$user="root";
$pwd="";
$dbname="beopenit";
//true or false
$conn=mysqli_connect($serveur,$user,$pwd,$dbname);

if(!$conn){
    echo "Erreur de connexion";
}

?>