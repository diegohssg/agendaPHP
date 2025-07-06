<?php
include '../db/db.php';

$id = intval($_GET['id']);
$conn->query("DELETE FROM eventos WHERE id = $id");

header("Location: ../index.php");
exit();
