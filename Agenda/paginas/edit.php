<?php
include '../db/db.php';


$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: ../index.php');
    exit;
}

// Buscar agendamento pelo ID
$stmt = $conn->prepare("SELECT * FROM eventos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$agendamento = $result->fetch_assoc();

if (!$agendamento) {
    echo "Agendamento não encontrado.";
    exit;
}

// Se enviou o formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $cliente = $_POST['cliente'];
    $data_inicio = $_POST['data_inicio_visita'];
    $data_fim = $_POST['data_fim_visita'];

    $stmt = $conn->prepare("UPDATE eventos SET titulo = ?, descricao = ?, cliente = ?, data_inicio_visita = ?, data_fim_visita = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $titulo, $descricao, $cliente, $data_inicio, $data_fim, $id);
    $stmt->execute();

    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Agendamento</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Editar Agendamento</h1>
    <form method="POST">
        <input type="text" name="titulo" placeholder="Título" required value="<?= htmlspecialchars($agendamento['titulo']) ?>">
        <input type="text" name="cliente" placeholder="Cliente" required value="<?= htmlspecialchars($agendamento['cliente']) ?>"><br>
        <textarea name="descricao" placeholder="Descrição" required><?= htmlspecialchars($agendamento['descricao']) ?></textarea><br>
        <label>Início:</label>
        <input type="datetime-local" name="data_inicio_visita" required value="<?= date('Y-m-d\TH:i', strtotime($agendamento['data_inicio_visita'])) ?>">
        <label>Fim:</label>
        <input type="datetime-local" name="data_fim_visita" required value="<?= date('Y-m-d\TH:i', strtotime($agendamento['data_fim_visita'])) ?>"><br>
        <button type="submit">Salvar Alterações</button>
        <a href="index.php" style="margin-left: 10px;">Cancelar</a>
    </form>
</body>
</html>