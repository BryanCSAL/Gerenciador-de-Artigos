<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Publicações</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Lista de Publicações</h1>
    </header>

    <nav>
        <ul>
            <li><a href="http://localhost/PHP_fatec/_Projeto_Jonatas/ProjetoDEFINITIVO_Jonas/gerenciar.php">Gerenciar</a></li>

        </ul>
    </nav>

    <section class="publicacoes">
        <?php
        // Conexão com o banco de dados
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "projeto_jonas";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica a conexão
        if ($conn->connect_error) {
            die("Conexão falhou: " . $conn->connect_error);
        }

        // Consulta SQL para buscar as publicações
        $sql = "SELECT id_publicacao, nome_publicacao, descricao_publicacao FROM publicacao";
        $result = $conn->query($sql);

        // Verifica se há resultados e exibe as publicações
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                // Cria o link para a página de detalhes da publicação
                $detalhesLink = "infoPublicacao.php?id=" . $row["id_publicacao"];
                
                echo "<article class='publicacao'>";
                echo "<h2><a href='" . htmlspecialchars($detalhesLink) . "'>" . htmlspecialchars($row["nome_publicacao"]) . "</a></h2>";
                echo "<p>" . htmlspecialchars($row["descricao_publicacao"]) . "</p>";
                echo "</article>";
            }
        } else {
            echo "<p>Nenhuma publicação encontrada.</p>";
        }

        // Fecha a conexão
        $conn->close();

        /*
            Exemplo do uso de OPERADORES ARITIMÉTICOS, INCREMENTO e FOREACH
            
            function avaliar_quantidade_minima ($quantidade){
                if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    foreach ($row["id_publicacao"] as $publicacao) {
                        $num_publicacao++
                        if (($num_publicacao - 1) > quantidade){
                            echo "O valor mínimo."
                        }
                }
                } else {
                    echo "<p>Nenhuma publicação encontrada.</p>";
                }
            } 
        */
        ?>
    </section>

    <footer>
        <p>&copy; 2024 Projeto de Publicações</p>
    </footer>
</body>
</html>
