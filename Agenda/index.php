<?php
include 'db/db.php';
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Agendamentos</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <h1>Agendamentos</h1>

    <body>
        <input type="text" id="filtroTabela" placeholder="Filtrar por texto..."><br>
        
        <div>
            <button type="submit"><a href="paginas/cad_agendamentos.php">Novo Agendamento</a></button>
            <a href="index.php"><button>Todos os agendamentos</button></a>
            <a href="index.php?filtro=futuros"><button>Agendamentos Futuros</button></a>
            <a href="index.php?filtro=passados"><button>Agendamentos Passados</button></a>
        </div>
    <table border="1" cellspacing="0" cellpadding="8" style="width: 50%; border-collapse: collapse;">
    <thead>
        <tr style="background-color: #f0f0f0;">
            <th>Título</th>
            <th>Cliente</th>
            <th>Descrição</th>
            <th>Início</th>
            <th>Fim</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>

    <?php
    $filtro = $_GET['filtro'] ?? 'todos'; // padrão: todos
    $dataHoje = date('Y-m-d H:i:s');

    $sql = "SELECT * FROM eventos WHERE 1=1";

    if ($filtro === 'futuros') {
        $sql .= " AND data_inicio_visita >= '$dataHoje'";
    } elseif ($filtro === 'passados') {
        $sql .= " AND data_inicio_visita < '$dataHoje'";
    }

    $sql .= " ORDER BY data_inicio_visita";
    $result = $conn->query($sql);       
    ?>
    <?php while ($row = $result->fetch_assoc()):
        $data_inicio = $row['data_inicio_visita'];
        $tipo = (strtotime($data_inicio) >= strtotime($dataHoje)) ? 'futuros' : 'passados';
        $status = $row['status'] ?? 'pendente';
    ?> 
        <h2>
            <?php
                if ($filtro === 'futuros') echo 'Agendamentos Futuros';
                elseif ($filtro === 'passados') echo 'Agendamentos Passados';
            ?>
        </h2>
        <tr data-tipo="<?= $tipo ?>" style="<?= $status === 'concluída' ? 'background-color: #e0ffe0;' : '' ?>">
            <td><?= wordwrap(htmlspecialchars($row['titulo']), 25, '<br>', false) ?></td>
            <td><?= wordwrap(htmlspecialchars($row['cliente']), 25, '<br>', false) ?></td>
            <td><?= nl2br(wordwrap(htmlspecialchars($row['descricao']), 25, '<br>', false)) ?></td>
            <td><?= date('d/m/Y H:i', strtotime($row['data_inicio_visita'])) ?></td>
            <td><?= date('d/m/Y H:i', strtotime($row['data_fim_visita'])) ?></td>
            <td><a href="paginas/edit.php?id=<?= $row['id'] ?>" class="btn-editar" onclick="return confirm('Deseja editar este agendamento?')">Editar</a>
                <a href="paginas/delete.php?id=<?= $row['id'] ?>" class="btn-excluir" onclick="return confirm('Deseja excluir este agendamento?')">Excluir</a><br>
            <?php if ($status === 'pendente'): ?>
            <a class="btn-concluir" href="paginas/concluir.php?id=<?= $row['id'] ?>" onclick="return confirm('Marcar como concluída?')">Concluir</a>
            <?php else: ?>
                <span style="color: green;">Concluída</span>
            <?php endif; ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
        <script>
            document.getElementById('filtroTabela').addEventListener('keyup', function() {
                let filtro = this.value.toLowerCase();
                let linhas = document.querySelectorAll('table tbody tr');

                linhas.forEach(function(linha) {
                    let textoLinha = linha.innerText.toLowerCase();
                    if (textoLinha.includes(filtro)) {
                        linha.style.display = '';
                    } else {
                        linha.style.display = 'none';
                    }
                });
            });
            </script>
    </body>
</html>
