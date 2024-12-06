<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Publicações</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <header>
        <h1>Gerenciamento de Publicações</h1>
    </header>
    
    <nav>
        <ul>
            <li><a href="http://localhost/PHP_fatec/_Projeto_Jonatas/ProjetoDEFINITIVO_Jonas/home.php">Home</a></li>
        </ul>
    </nav>
    
    <section>
        <h2>Adicionar Nova Publicação</h2>
        <form action="" method="POST">
            <label for="nome_publicacao">Título:</label><br>
            <input type="text" id="nome_publicacao" name="nome_publicacao" required><br>

            <label for="descricao_publicacao">Descrição:</label><br>
            <textarea id="descricao_publicacao" name="descricao_publicacao" required></textarea><br>
                
            <label for="autores_publicacao">Autores:</label><br>
            <textarea id="autores_publicacao" name="autores_publicacao" required></textarea><br>

            <label for="classificacao_autores">Classificação:</label><br>
            <textarea id="classificacao_autores" name="classificacao_autores" required></textarea><br>

            <label for="divulgacao_publicacao">Divulgação:</label><br>
            <textarea id="divulgacao_publicacao" name="divulgacao_publicacao" required></textarea><br>

            <label for="convidados_publicacao">Convidados:</label><br>
            <textarea id="convidados_publicacao" name="convidados_publicacao" required></textarea><br>

            <input type="submit" value="Adicionar Publicação">
        </form>
    </section>

    <section>
        <h2>Gerenciar Publicações Existentes</h2>
        <table>
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Conexão com o banco de dados
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "projeto_jonas";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Falha na conexão: " . $conn->connect_error);
                }

                $sql = "SELECT id_publicacao, nome_publicacao FROM publicacao";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['nome_publicacao'] . "</td>";
                        echo "<td>
                                <a href='editar.php?id=" . $row['id_publicacao'] . "'>Editar</a> |
                                <a href='remover_publicacao.php?id=" . $row['id_publicacao'] . "' onclick='return confirm(\"Tem certeza que deseja remover esta publicação?\")'>Remover</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>Nenhuma publicação encontrada.</td></tr>";
                }

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Captura os dados do formulário
                    $nome_publicacao = $_POST['nome_publicacao'];
                    $descricao_publicacao = $_POST['descricao_publicacao'];
                    $autores_publicacao = $_POST['autores_publicacao'];
                    $classificacao_autores = $_POST['classificacao_autores'];
                    $divulgacao_publicacao = $_POST['divulgacao_publicacao'];
                    $convidados_publicacao = $_POST['convidados_publicacao'];

                    // Prepared statement
                    $stmt = $conn->prepare("INSERT INTO publicacao (nome_publicacao, descricao_publicacao, autores_publicacao, classificacao_autores, divulgacao_publicacao, convidados_publicacao) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("ssssss", $nome_publicacao, $descricao_publicacao, $autores_publicacao, $classificacao_autores, $divulgacao_publicacao, $convidados_publicacao);

                    // Executar a consulta SQL
                    if ($stmt->execute()) {
                        echo "Nova publicação criada com sucesso.";
                    } else {
                        echo "Erro: " . $stmt->error;
                    }

                    $stmt->close();
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </section>

</body>
</html>
