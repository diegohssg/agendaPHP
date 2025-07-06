<?php
include '../db/db.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $conn->prepare("UPDATE eventos SET status = 'concluída' WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: ../index.php");
exit;
?>
