<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/style.css">
        <script>
            function validarFormulario(event) {
                const dataInicio = document.getElementById('data_inicio_visita').value;
                const dataFim = document.getElementById('data_fim_visita').value;

                if (new Date(dataFim) <= new Date(dataInicio)) {
                alert('A data final deve ser maior que a data inicial.');
                event.preventDefault(); // Impede o envio do formulário
                }
            }
        </script>
        <title>Cadastro de Agendamentos</title>
    </head>
    <body>
        <header>
            <h1>CADASTRO DE AGENDAMENTOS</h1>
        </header>
        
        <form action="add.php" method="POST" onsubmit="validarFormulario(event)">
            <input type="text" id="titulo" name="titulo" placeholder="Título" required><br>
            <input type="text" id="cliente" name="cliente" placeholder="Cliente" required><br>
            <input type="datetime-local" id="data_inicio_visita" name="data_inicio_visita" required><br>
            <input type="datetime-local" id="data_fim_visita" name="data_fim_visita" required><br>
            <input type="text" id="descricao" name="descricao" placeholder="Descrição" required><br>
            <button type="submit">Adicionar</button>
        </form>
        <?php
   
        ?>
    </body>
