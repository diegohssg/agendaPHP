<?php
    $host = '127.0.0.1';
    $user = 'root';
    $pass = '';
    $dbname = 'agenda_db';

    $conn = new mysqli($host, $user, $pass, $dbname);
    if ($conn->connect_error) {
        die("Erro: " . $conn->connect_error);
    }
?>