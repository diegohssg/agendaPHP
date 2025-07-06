<?php
include '../db/db.php';

    $titulo = $_POST['titulo'];
    $data_ini = $_POST['data_inicio_visita'];
    $data_fim = $_POST['data_fim_visita'];
    $cliente = $_POST['cliente'];
    $descricao = $_POST['descricao'];
    

    $stmt = $conn->prepare("INSERT INTO eventos (titulo, data_inicio_visita, data_fim_visita, cliente, descricao) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $titulo, $data_ini, $data_fim, $cliente, $descricao);
    $stmt->execute();

header("Location: ../index.php");
exit();

?>