<?php
    $server = "localhost";
   
    $user = "omar";
    $password = "omar771";
    $db = "academic";
    
    $conn = mysqli_connect($server, $user, $password, $db);

    if (!$conn) {
        header('Location: ../errors/error.html');
        exit();
    }


?>